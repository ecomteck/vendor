<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Controller\AbstractController\Order;

/**
 * Order abstract controller vendor trait
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
        $order = $this->vendorGetOrder($orderId);
        if (!empty($order)) {
            $this->setVendorId($order->getVendorId());
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
}