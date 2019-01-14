<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Observer\Framework\Model\AbstractModel;

/**
 * Model before delete observer
 */
class BeforeDelete extends \Ecombricks\Vendor\Observer\Framework\Model\AbstractModel\BeforeDelete\Vendor
{
    
    /**
     * Vendor resource
     * 
     * @var \Ecombricks\Vendor\Model\ResourceModel\Vendor 
     */
    protected $vendorResource;
    
    /**
     * Constructor
     * 
     * @param \Ecombricks\Vendor\Model\ResourceModel\Vendor $vendorResource
     * @param array $targetedTypes
     * @return void
     */
    public function __construct(
        \Ecombricks\Vendor\Model\ResourceModel\Vendor $vendorResource,
        $targetedTypes = [
            'catalogProduct' => \Magento\Catalog\Model\Product::class
        ]
    )
    {
        $this->vendorResource = $vendorResource;
        parent::__construct($targetedTypes);
    }
    
    /**
     * Execute
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        parent::execute($observer);
        $object = $this->getObject($observer);
        if (!$object) {
            return $this;
        }
        if (!$this->isTargetedType($object, [\Ecombricks\Vendor\Model\Vendor::class])) {
            return $this;
        }
        $this->vendorResource->deleteRelatedEntities($object, 'ecombricks_vendor_catalog_product_entity');
        return $this;
    }

}