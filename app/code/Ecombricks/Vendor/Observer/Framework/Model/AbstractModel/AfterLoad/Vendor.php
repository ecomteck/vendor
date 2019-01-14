<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Observer\Framework\Model\AbstractModel\AfterLoad;

/**
 * Model after load vendor observer
 */
class Vendor implements \Magento\Framework\Event\ObserverInterface
{
    
    use \Ecombricks\Vendor\Observer\Framework\Model\AbstractModelTrait,
        \Ecombricks\Vendor\Observer\Framework\Model\AbstractModel\AfterLoad\VendorTrait;
    
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
    public function __construct($targetedTypes = [])
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
        $this->vendorExecute($observer, $this->targetedTypes);
        return $this;
    }

}