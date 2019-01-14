<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\GuestCart;

/**
 * Guest cart total management model plugin
 */
class GuestCartTotalManagement
{
    
    /**
     * Around collect totals
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestCartTotalManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
     * @param string $shippingCarrierCode
     * @param string $shippingMethodCode
     * @param \Magento\Quote\Api\Data\TotalsAdditionalDataInterface $additionalData
     * @return \Magento\Quote\Api\Data\TotalsInterface
     */
    public function aroundCollectTotals(
        \Magento\Quote\Model\GuestCart\GuestCartTotalManagement $subject,
        \Closure $proceed,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        $shippingCarrierCode = null,
        $shippingMethodCode = null,
        \Magento\Quote\Api\Data\TotalsAdditionalDataInterface $additionalData = null
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $paymentMethod, $shippingCarrierCode, $shippingMethodCode, $additionalData);
    }
    
}
