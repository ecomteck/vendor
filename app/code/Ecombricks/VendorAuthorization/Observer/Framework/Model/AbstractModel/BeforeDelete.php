<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorAuthorization\Observer\Framework\Model\AbstractModel;

/**
 * Model before delete observer
 */
class BeforeDelete implements \Magento\Framework\Event\ObserverInterface
{
    
    use \Ecombricks\Vendor\Observer\Framework\Model\AbstractModelTrait,
        \Ecombricks\Vendor\Observer\Framework\Model\AbstractModel\BeforeDelete\VendorFlagTrait;
    
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
    public function __construct($targetedTypes = ['authorizationRole' => \Magento\Authorization\Model\Role::class])
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