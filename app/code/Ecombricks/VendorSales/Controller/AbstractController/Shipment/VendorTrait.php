<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Controller\AbstractController\Shipment;

/**
 * Shipment abstract controller vendor trait
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
     * Before dispatch
     * 
     * @param \Magento\Framework\App\RequestInterface $request
     * @return $this
     */
    public function vendorBeforeDispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $shipmentId = $request->getParam('shipment_id');
        $shipment = $this->vendorGetShipment($shipmentId);
        if (!empty($shipment)) {
            $this->setVendorId($shipment->getVendorId());
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
}