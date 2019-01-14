<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorWishlist\Plugin\Model;

/**
 * Wishlist model factory plugin
 */
class WishlistFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Wishlist\Model\WishlistFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Wishlist\Model\Wishlist
     */
    public function aroundCreate(
        \Magento\Wishlist\Model\WishlistFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}