<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Api;

/**
 * Guest quote cart management interface
 */
interface GuestCartManagementInterface extends \Magento\Quote\Api\GuestCartManagementInterface
{
    
    /**
     * Create empty cart
     * 
     * @param int $vendorId
     * @return int
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function vendorCreateEmptyCart($vendorId);
    
}