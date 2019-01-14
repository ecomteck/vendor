<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Controller\Adminhtml\Order;

/**
 * Order controller vendor trait
 */
trait VendorTrait
{
    
    /**
     * Get order
     * 
     * @param string|int $orderId
     * @return \Magento\Sales\Api\Data\OrderInterface|null
     */
    public function vendorGetOrder($orderId)
    {
        if (empty($orderId)) {
            return null;
        }
        try {
            $order = $this->vendorOrderRepository->get($orderId);
        } catch (\Exception $exception) {
            return null;
        }
        return $order;
    }
    
    /**
     * Before dispatch
     * 
     * @param \Magento\Framework\App\RequestInterface $request
     * @return $this
     */
    public function vendorBeforeDispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $orderId = $request->getParam('order_id');
        if (empty($orderId)) {
            $orderId = $request->getParam('id');
        }
        if (!empty($orderId)) {
            $order = $this->vendorGetOrder($orderId);
            if ($order) {
                $this->setVendorId($order->getVendorId());
            }
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
}