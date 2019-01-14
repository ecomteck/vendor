<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\AdminOrder;

/**
 * Create order model plugin
 */
class Create extends \Ecombricks\Vendor\Framework\Plugin\AbstractPlugin
{
    
    /**
     * Around initialize from order
     * 
     * @param \Magento\Sales\Model\AdminOrder\Create $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order $order
     * @return \Magento\Sales\Model\AdminOrder\Create
     */
    public function aroundInitFromOrder(
        \Magento\Sales\Model\AdminOrder\Create $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order $order
    )
    {
        $this->copyVendorId($order, $subject);
        $result = $proceed($order);
        return $result;
    }
    
    /**
     * Around initialize from order item
     * 
     * @param \Magento\Sales\Model\AdminOrder\Create $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order\Item $orderItem
     * @param int $qty
     * @return \Magento\Quote\Model\Quote\Item|string|\Magento\Sales\Model\AdminOrder\Create
     */
    public function aroundInitFromOrderItem(
        \Magento\Sales\Model\AdminOrder\Create $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order\Item $orderItem,
        $qty = null
    )
    {
        $this->copyVendorId($orderItem->getOrder(), $subject);
        $result = $proceed($orderItem, $qty);
        return $result;
    }
    
    /**
     * Around get customer wishlist
     * 
     * @param \Magento\Sales\Model\AdminOrder\Create $subject
     * @param \Closure $proceed
     * @param bool $cacheReload
     * @return \Magento\Wishlist\Model\Wishlist|false
     */
    public function aroundGetCustomerWishlist(
        \Magento\Sales\Model\AdminOrder\Create $subject,
        \Closure $proceed,
        $cacheReload = false
    )
    {
        $result = $proceed($cacheReload);
        $this
            ->setSubject($subject)
            ->setVendorId($result);
        return $result;
    }
    
    /**
     * Around get customer compare list
     * 
     * @param \Magento\Sales\Model\AdminOrder\Create $subject
     * @param \Closure $proceed
     * @return \Magento\Catalog\Model\Product\Compare\ListCompare|false
     */
    public function aroundGetCustomerCompareList(
        \Magento\Sales\Model\AdminOrder\Create $subject,
        \Closure $proceed
    )
    {
        $result = $proceed();
        $this
            ->setSubject($subject)
            ->setVendorId($result);
        return $result;
    }
    
}