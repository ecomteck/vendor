<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model;

/**
 * Cart ID provider model trait
 */
trait CartIdProviderTrait
{
    
    /**
     * Get cart ID
     * 
     * @param mixed $vendorId
     * @return mixed
     */
    public function vendorGetCartId($vendorId)
    {
        $cartId = null;
        try {
            if ($this->vendorUserContext->getUserType() === \Magento\Authorization\Model\UserContextInterface::USER_TYPE_CUSTOMER) {
                $customerId = $this->vendorUserContext->getUserId();
                $cart = $this->vendorCartManagement->vendorGetCartForCustomer($vendorId, $customerId);
                if ($cart) {
                    $cartId = $cart->getId();
                }
            }
        } catch (\Exception $e) {
            
        }
        return $cartId;
    }
    
}