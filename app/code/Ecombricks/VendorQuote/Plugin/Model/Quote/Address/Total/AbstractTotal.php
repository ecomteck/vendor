<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\Quote\Address\Total;

/**
 * Quote address abstract total plugin
 */
class AbstractTotal
{
    
    /**
     * Around collect
     * 
     * @param \Magento\Quote\Model\Quote\Address\Total\AbstractTotal $subject
     * @param \Closure $proceed
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
     */
    public function aroundCollect(
        \Magento\Quote\Model\Quote\Address\Total\AbstractTotal $subject,
        \Closure $proceed,
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    )
    {
        if (method_exists($subject, 'setVendorId')) {
            $subject->setVendorId($quote->getVendorId());
        }
        return $proceed($quote, $shippingAssignment, $total);
    }

    /**
     * Around fetch
     * 
     * @param \Magento\Quote\Model\Quote\Address\Total\AbstractTotal $subject
     * @param \Closure $proceed
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return array
     */
    public function aroundFetch(
        \Magento\Quote\Model\Quote\Address\Total\AbstractTotal $subject,
        \Closure $proceed,
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Model\Quote\Address\Total $total
    )
    {
        if (method_exists($subject, 'setVendorId')) {
            $subject->setVendorId($quote->getVendorId());
        }
        return $proceed($quote, $total);
    }
    
}