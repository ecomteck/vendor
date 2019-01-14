<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorWishlist\Plugin\Model\ResourceModel\Item;

/**
 * Wishlist item collection factory plugin
 */
class CollectionFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Wishlist\Model\ResourceModel\Item\CollectionFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Wishlist\Model\ResourceModel\Item\Collection
     */
    public function aroundCreate(
        \Magento\Wishlist\Model\ResourceModel\Item\CollectionFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }

}