<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\ResourceModel\Order;

/**
 * Order collection factory plugin
 */
class CollectionFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{

    /**
     * Around create
     * 
     * @param \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $subject
     * @param \Closure $proceed
     * @param int $customerId
     * @return \Magento\Sales\Model\ResourceModel\Order\Collection
     */
    public function aroundCreate(
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $subject,
        \Closure $proceed,
        $customerId = null
    )
    {
        $collection = $proceed($customerId);
        $this
            ->setSubject($subject)
            ->setVendorId($collection);
        return $collection;
    }

}