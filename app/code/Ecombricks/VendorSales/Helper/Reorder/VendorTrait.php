<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Helper\Reorder;

/**
 * Reorder helper vendor trait
 */
trait VendorTrait
{
    
    /**
     * Scope config vendor ID
     * 
     * @var int 
     */
    protected $scopeConfigVendorId;
    
    /**
     * Before can reorder
     * 
     * @param int $orderId
     * @return $this
     */
    public function vendorBeforeCanReorder($orderId)
    {
        $this->scopeConfigVendorId = $this->scopeConfig->getVendorId();
        $order = $this->orderRepository->get($orderId);
        if ($order) {
            $this->scopeConfig->setVendorId($order->getVendorId());
        }
        return $this;
    }
    
    /**
     * After can reorder
     * 
     * @return $this
     */
    public function vendorAfterCanReorder()
    {
        $this->scopeConfig->setVendorId($this->scopeConfigVendorId);
        return $this;
    }
    
}