<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model;

/**
 * Quote model plugin
 */
class Quote
{
    
    /**
     * Around add product
     * 
     * @param \Magento\Quote\Model\Quote $subject
     * @param \Closure $proceed
     * @param \Magento\Catalog\Model\Product $product
     * @param null|float|\Magento\Framework\DataObject $request
     * @param null|string $processMode
     * @return \Magento\Quote\Model\Quote\Item|string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function aroundAddProduct(
        \Magento\Quote\Model\Quote $subject,
        \Closure $proceed,
        \Magento\Catalog\Model\Product $product,
        $request = null,
        $processMode = \Magento\Catalog\Model\Product\Type\AbstractType::PROCESS_MODE_FULL
    )
    {
        if ($subject->getVendorId() != $product->getVendorId()) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __("Product '%1' is not available for '%2' vendor.", [ $product->getName(), $subject->getVendorName() ])
            );
        }
        return $proceed($product, $request, $processMode);
    }
    
}