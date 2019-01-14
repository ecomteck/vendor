<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Controller\Adminhtml\Creditmemo;

/**
 * Creditmemo controller vendor trait
 */
trait VendorTrait
{
    
    /**
     * Get creditmemo
     * 
     * @param string|int $creditmemoId
     * @return \Magento\Sales\Api\Data\CreditmemoInterface|null
     */
    public function vendorGetCreditmemo($creditmemoId)
    {
        if (empty($creditmemoId)) {
            return null;
        }
        try {
            $creditmemo = $this->vendorCreditmemoRepository->get($creditmemoId);
        } catch (\Exception $exception) {
            return null;
        }
        return $creditmemo;
    }
    
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
        $creditmemoId = $request->getParam('creditmemo_id');
        if (empty($creditmemoId)) {
            $creditmemoId = $request->getParam('id');
        }
        $orderId = $request->getParam('order_id');
        if (!empty($creditmemoId)) {
            $creditmemo = $this->vendorGetCreditmemo($creditmemoId);
            if ($creditmemo) {
                $this->setVendorId($creditmemo->getVendorId());
            }
        } else if (!empty($orderId)) {
            $order = $this->vendorGetOrder($orderId);
            if ($order) {
                $this->setVendorId($order->getVendorId());
            }
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
}