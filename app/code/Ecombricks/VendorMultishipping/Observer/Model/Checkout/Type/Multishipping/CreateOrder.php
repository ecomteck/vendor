<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorMultishipping\Observer\Model\Checkout\Type\Multishipping;

/**
 * Multishipping checkout create order observer
 */
class CreateOrder implements \Magento\Framework\Event\ObserverInterface
{
    
    /**
     * Execute
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $event = $observer->getEvent();
        if (!$event) {
            return $this;
        }
        $quote = $event->getQuote();
        $order = $event->getOrder();
        if (!$quote || !$order) {
            return $this;
        }
        $order->setVendorId($quote->getVendorId());
        return $this;
    }

}