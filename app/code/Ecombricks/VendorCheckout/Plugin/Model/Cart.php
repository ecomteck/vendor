<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Plugin\Model;

/**
 * Cart model plugin
 */
class Cart
{
    
    /**
     * Around add product
     * 
     * @param \Magento\Checkout\Model\Cart $subject
     * @param \Closure $proceed
     * @param \Magento\Catalog\Model\Product|int|string $productInfo $productInfo
     * @param \Magento\Framework\DataObject|int|array $requestInfo
     * @return type
     */
    public function aroundAddProduct(
        \Magento\Checkout\Model\Cart $subject,
        \Closure $proceed,
        $productInfo,
        $requestInfo = null
    )
    {
        $product = $subject->setProductVendorId($productInfo);
        return $proceed($product, $requestInfo);
    }
    
    /**
     * Around add products by ids
     * 
     * @param \Magento\Checkout\Model\Cart $subject
     * @param \Closure $proceed
     * @param @param int[] $productIds
     * @return \Magento\Checkout\Model\Cart
     */
    public function aroundAddProductsByIds(
        \Magento\Checkout\Model\Cart $subject,
        \Closure $proceed,
        $productIds
    )
    {
        return $subject->vendorAddProductsByIds($productIds);
    }
    
}