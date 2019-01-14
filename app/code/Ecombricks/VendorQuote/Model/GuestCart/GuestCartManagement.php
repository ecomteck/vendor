<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model\GuestCart;

/**
 * Guest cart management model
 */
class GuestCartManagement extends \Magento\Quote\Model\GuestCart\GuestCartManagement 
    implements \Ecombricks\VendorQuote\Api\GuestCartManagementInterface 
{
    
    /**
     * Create empty cart
     * 
     * @param int $vendorId
     * @return int
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function vendorCreateEmptyCart($vendorId)
    {
        $this->setVendorId($vendorId);
        return $this->createEmptyCart();
    }
    
}