<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Api;

/**
 * Quote cart total management interface
 */
interface CartTotalManagementInterface extends \Magento\Quote\Api\CartTotalManagementInterface
{
    
    /**
     * Collect totals
     *
     * @param int $cartId
     * @param int $vendorId
     * @param \Magento\Quote\Api\Data\PaymentInterface
     * @param string $shippingCarrierCode
     * @param string $shippingMethodCode
     * @param \Magento\Quote\Api\Data\TotalsAdditionalDataInterface $additionalData
     * @return \Magento\Quote\Api\Data\TotalsInterface
     */
    public function vendorCollectTotals(
        $cartId,
        $vendorId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        $shippingCarrierCode = null,
        $shippingMethodCode = null,
        \Magento\Quote\Api\Data\TotalsAdditionalDataInterface $additionalData = null
    );
    
}