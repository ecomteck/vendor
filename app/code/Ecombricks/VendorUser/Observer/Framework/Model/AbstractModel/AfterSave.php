<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorUser\Observer\Framework\Model\AbstractModel;

/**
 * Model after save observer
 */
class AfterSave implements \Magento\Framework\Event\ObserverInterface
{
    
    use \Ecombricks\Vendor\Observer\Framework\Model\AbstractModelTrait,
        \Ecombricks\Vendor\Observer\Framework\Model\AbstractModel\AfterSave\VendorFlagTrait,
        \Ecombricks\Vendor\Observer\Framework\Model\AbstractModel\AfterSave\VendorsTrait;
    
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
    public function __construct($targetedTypes = ['user' => \Magento\User\Model\User::class])
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
        $this->vendorsExecute($observer, $this->targetedTypes);
        return $this;
    }

}