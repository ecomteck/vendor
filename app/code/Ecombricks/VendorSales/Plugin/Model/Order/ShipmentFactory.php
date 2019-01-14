<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order;

/**
 * Shipment model factory plugin
 */
class ShipmentFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Sales\Model\Order\ShipmentFactory $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order $order
     * @param array $items
     * @param array|null $tracks
     * @return \Magento\Sales\Api\Data\ShipmentInterface
     */
    public function aroundCreate(
        \Magento\Sales\Model\Order\ShipmentFactory $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order $order,
        array $items = [],
        $tracks = null
    )
    {
        $object = $proceed($order, $items, $tracks);
        return $object;
    }
    
}