<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorAuthorization\Observer\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Collection after load observer
 */
class AfterLoad implements \Magento\Framework\Event\ObserverInterface
{
    
    use \Ecombricks\Vendor\Observer\Framework\Model\ResourceModel\Db\Collection\AbstractCollectionTrait,
        \Ecombricks\Vendor\Observer\Framework\Model\ResourceModel\Db\Collection\AbstractCollection\AfterLoad\VendorFlagTrait;
    
    /**
     * Targeted types
     */
    protected $targetedTypes = [];
    
    /**
     * Constructor
     * 
     * @param array $targetedTypes
     * @return void
     */
    public function __construct($targetedTypes = ['authorizationRole' => \Magento\Authorization\Model\ResourceModel\Role\Collection::class])
    {
        $this->targetedTypes = $targetedTypes;
    }
    
    /**
     * Execute
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->vendorFlagExecute($observer, $this->targetedTypes);
        return $this;
    }

}