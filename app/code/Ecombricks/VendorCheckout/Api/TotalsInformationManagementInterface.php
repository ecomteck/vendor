<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Api;

/**
 * Checkout totals information management interface
 */
interface TotalsInformationManagementInterface extends \Magento\Checkout\Api\TotalsInformationManagementInterface
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
    );
    
}