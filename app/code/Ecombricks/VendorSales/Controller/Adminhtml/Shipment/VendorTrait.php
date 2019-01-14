<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Controller\Adminhtml\Shipment;

/**
 * Shipment controller vendor trait
 */
trait VendorTrait
{
    
    /**
     * Get shipment
     * 
     * @param string|int $shipmentId
     * @return \Magento\Sales\Api\Data\ShipmentInterface|null
     */
    public function vendorGetShipment($shipmentId)
    {
        if (empty($shipmentId)) {
            return null;
        }
        try {
            $shipment = $this->vendorShipmentRepository->get($shipmentId);
        } catch (\Exception $exception) {
            return null;
        }
        return $shipment;
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
        $shipmentId = $request->getParam('shipment_id');
        if (empty($shipmentId)) {
            $shipmentId = $request->getParam('id');
        }
        $orderId = $request->getParam('order_id');
        if (!empty($shipmentId)) {
            $shipment = $this->vendorGetShipment($shipmentId);
            if ($shipment) {
                $this->setVendorId($shipment->getVendorId());
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