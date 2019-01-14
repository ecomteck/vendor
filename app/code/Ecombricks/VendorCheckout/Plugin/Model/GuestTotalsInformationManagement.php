<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Plugin\Model;

/**
 * Guest totals information management model plugin
 */
class GuestTotalsInformationManagement
{
    
    /**
     * Around calculate
     * 
     * @param \Magento\Checkout\Model\GuestTotalsInformationManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\Checkout\Api\Data\TotalsInformationInterface $addressInformation
     * @return \Magento\Quote\Api\Data\TotalsInterface
     */
    public function aroundCalculate(
        \Magento\Checkout\Model\GuestTotalsInformationManagement $subject,
        \Closure $proceed,
        $cartId,
        \Magento\Checkout\Api\Data\TotalsInformationInterface $addressInformation
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $addressInformation);
    }
    
}
