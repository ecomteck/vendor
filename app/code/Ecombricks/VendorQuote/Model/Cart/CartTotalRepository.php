<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model\Cart;

/**
 * Cart total repository model
 */
class CartTotalRepository extends \Magento\Quote\Model\Cart\CartTotalRepository 
    implements \Ecombricks\VendorQuote\Api\CartTotalRepositoryInterface 
{
    
    /**
     * Get
     * 
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\Quote\Api\Data\TotalsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGet($cartId, $vendorId)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->get($cartId);
    }
    
}