<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Ui\DataProvider\Vendor\Form\Modifier;

/**
 * Vendor form data provider abstract modifier
 */
abstract class AbstractModifier implements \Magento\Ui\DataProvider\Modifier\ModifierInterface
{
    
    use \Ecombricks\Ui\DataProvider\Modifier\ModifierTrait;
    
    /**
     * Vendor data scope
     */
    const DATA_SCOPE_VENDOR = 'data';
    
    /**
     * Container prefix
     */
    const CONTAINER_PREFIX = 'container_';
    
    /**
     * Meta config path
     */
    const META_CONFIG_PATH = '/arguments/data/config';
    
    /**
     * Locator
     * 
     * @var \Ecombricks\Vendor\Model\Locator\LocatorInterface
     */
    protected $locator;
    
    /**
     * Constructor
     * 
     * @param \Ecombricks\Vendor\Model\Locator\LocatorInterface $locator
     * @param \Magento\Framework\Stdlib\ArrayManager $arrayManager
     * @return void
     */
    public function __construct(
        \Ecombricks\Vendor\Model\Locator\LocatorInterface $locator,
        \Magento\Framework\Stdlib\ArrayManager $arrayManager
    )
    {
        $this->locator = $locator;
        $this->arrayManager = $arrayManager;
    }
    
    /**
     * Get vendor
     * 
     * @return \Ecombricks\Vendor\Model\Vendor
     */
    protected function getVendor()
    {
        return $this->locator->getVendor();
    }
    
    /**
     * Get vendor ID
     * 
     * @return int
     */
    protected function getVendorId()
    {
        return $this->getVendor()->getId();
    }
    
    /**
     * Initialize vendor data
     * 
     * @return $this
     */
    protected function initializeVendorData()
    {
        $vendorId = $this->getVendorId();
        if (!isset($this->data[$vendorId])) {
            $this->data[$vendorId] = [];
        }
        return $this;
    }
    
    /**
     * Check if has vendor data
     * 
     * @param string $path
     * @return bool
     */
    protected function hasVendorData($path)
    {
        $this->initializeVendorData();
        return $this->arrayManager->exists($path, $this->data[$this->getVendorId()]);
    }
    
    /**
     * Get vendor data
     * 
     * @param type $path
     */
    protected function getVendorData($path)
    {
        $this->initializeVendorData();
        return $this->arrayManager->get($path, $this->data[$this->getVendorId()]);
    }
    
    /**
     * Set vendor data
     * 
     * @param array $data
     * @param string $path
     * @return $this
     */
    protected function setVendorData($data, $path)
    {
        $this->initializeVendorData();
        $vendorId = $this->getVendorId();
        $this->data[$vendorId] = $this->arrayManager->set($path, $this->data[$vendorId], $data);
        return $this;
    }
    
    /**
     * Remove vendor data
     * 
     * @param string $path
     * @return $this
     */
    protected function removeVendorData($path)
    {
        $this->initializeVendorData();
        $vendorId = $this->getVendorId();
        $this->data[$vendorId] = $this->arrayManager->remove($path, $this->data[$vendorId]);
        return $this;
    }
    
    /**
     * Set vendor field value
     * 
     * @param string $fieldName
     * @param mixed|null $value
     * @return $this
     */
    protected function setVendorFieldValue($fieldName, $value = null)
    {
        if (!$this->hasVendorData($fieldName)) {
            $this->setVendorData($value !== null ? $value : $this->getVendor()->getData($fieldName), $fieldName);
        }
        return $this;
    }
    
}