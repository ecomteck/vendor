<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model\Cart;

/**
 * Cart total management model
 */
class CartTotalManagement extends \Magento\Quote\Model\Cart\CartTotalManagement 
    implements \Ecombricks\VendorQuote\Api\CartTotalManagementInterface 
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
    )
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->collectTotals($cartId, $paymentMethod, $shippingCarrierCode, $shippingMethodCode, $additionalData);
    }
    
}