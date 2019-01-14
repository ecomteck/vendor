<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Model;

/**
 * Checkout totals information management model
 */
class TotalsInformationManagement extends \Magento\Checkout\Model\TotalsInformationManagement
    implements \Ecombricks\VendorCheckout\Api\TotalsInformationManagementInterface 
{
    
    /**
     * Calculate
     *
     * @param int $cartId
     * @param int $vendorId
     * @param \Magento\Checkout\Api\Data\TotalsInformationInterface $addressInformation
     * @return \Magento\Quote\Api\Data\TotalsInterface
     */
    public function vendorCalculate(
        $cartId,
        $vendorId,
        \Magento\Checkout\Api\Data\TotalsInformationInterface $addressInformation
    )
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->calculate($cartId, $addressInformation);
    }
    
}