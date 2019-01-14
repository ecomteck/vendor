<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Ui\DataProvider\Product\Form\Modifier;

/**
 * Abstract product form data provider modifier
 */
abstract class AbstractModifier extends \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier
{
    
    use \Ecombricks\Ui\DataProvider\Modifier\ModifierTrait;
    
    /**
     * Locator
     * 
     * @var \Magento\Catalog\Model\Locator\LocatorInterface
     */
    protected $locator;
    
    /**
     * Vendor management
     * 
     * @var \Ecombricks\Vendor\Model\VendorManagement
     */
    protected $vendorManagement;
    
    /**
     * Scope name
     * 
     * @var string
     */
    protected $scopeName;
    
    /**
     * Scope prefix
     * 
     * @var string
     */
    protected $scopePrefix;
    
    /**
     * Constructor
     * 
     * @param \Magento\Catalog\Model\Locator\LocatorInterface $locator
     * @param \Magento\Framework\Stdlib\ArrayManager $arrayManager
     * @param \Ecombricks\Vendor\Model\VendorManagement $vendorManagement
     * @param string $scopeName
     * @param string $scopePrefix
     * @return void
     */
    public function __construct(
        \Magento\Catalog\Model\Locator\LocatorInterface $locator,
        \Magento\Framework\Stdlib\ArrayManager $arrayManager,
        \Ecombricks\Vendor\Model\VendorManagement $vendorManagement,
        $scopeName = '',
        $scopePrefix = ''
    )
    {
        $this->locator = $locator;
        $this->arrayManager = $arrayManager;
        $this->vendorManagement = $vendorManagement;
        $this->scopeName = $scopeName;
        $this->scopePrefix = $scopePrefix;
    }
    
    /**
     * Get product
     * 
     * @return \Magento\Catalog\Api\Data\ProductInterface
     */
    protected function getProduct()
    {
        return $this->locator->getProduct();
    }
    
    /**
     * Get product ID
     * 
     * @return int
     */
    protected function getProductId()
    {
        return $this->getProduct()->getId();
    }
    
    /**
     * Get product type ID
     * 
     * @return string
     */
    protected function getProductTypeId()
    {
        return $this->getProduct()->getTypeId();
    }
    
    /**
     * Get vendor ID
     * 
     * @return int
     */
    protected function getVendorId()
    {
        return (int) $this->getProduct()->getVendorId();
    }
    
    /**
     * Initialize product data
     * 
     * @return $this
     */
    protected function initializeProductData()
    {
        $productId = $this->getProductId();
        if (!isset($this->data[$productId][static::DATA_SOURCE_DEFAULT])) {
            $this->data[$productId][static::DATA_SOURCE_DEFAULT] = [];
        }
        return $this;
    }
    
    /**
     * Check if has product data
     * 
     * @param string $path
     * @return bool
     */
    protected function hasProductData($path)
    {
        $this->initializeProductData();
        return $this->arrayManager->exists($path, $this->data[$this->getProductId()][static::DATA_SOURCE_DEFAULT]);
    }
    
    /**
     * Get product data
     * 
     * @param type $path
     */
    protected function getProductData($path)
    {
        $this->initializeProductData();
        return $this->arrayManager->get($path, $this->data[$this->getProductId()][static::DATA_SOURCE_DEFAULT]);
    }
    
    /**
     * Set product data
     * 
     * @param array $data
     * @param string $path
     * @return $this
     */
    protected function setProductData($data, $path)
    {
        $this->initializeProductData();
        $productId = $this->getProductId();
        $this->data[$productId][static::DATA_SOURCE_DEFAULT] = $this->arrayManager->set($path, $this->data[$productId][static::DATA_SOURCE_DEFAULT], $data);
        return $this;
    }
    
    /**
     * Remove product data
     * 
     * @param string $path
     * @return $this
     */
    protected function removeProductData($path)
    {
        $this->initializeProductData();
        $productId = $this->getProductId();
        $this->data[$productId][static::DATA_SOURCE_DEFAULT] = $this->arrayManager->remove($path, $this->data[$productId][static::DATA_SOURCE_DEFAULT]);
        return $this;
    }
    
    /**
     * Set product attribute value
     * 
     * @param string $attributeCode
     * @param mixed|null $attributeValue 
     * @return $this
     */
    protected function setProductAttributeValue($attributeCode, $attributeValue = null)
    {
        if (!$this->hasProductData($attributeCode)) {
            $this->setProductData($attributeValue !== null ? $attributeValue : $this->getProduct()->getData($attributeCode), $attributeCode);
        }
        return $this;
    }
    
}