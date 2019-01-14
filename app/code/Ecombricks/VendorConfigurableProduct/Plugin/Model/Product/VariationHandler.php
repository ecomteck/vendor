<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfigurableProduct\Plugin\Model\Product;

/**
 * Configurable product variation handler model plugin
 */
class VariationHandler extends \Ecombricks\Vendor\Framework\Plugin\AbstractPlugin
{
    
    /**
     * Around generate simple products
     * 
     * @param \Magento\ConfigurableProduct\Model\Product\VariationHandler $subject
     * @param \Closure $proceed
     * @param \Magento\Catalog\Model\Product $parentProduct
     * @param array $productsData
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function aroundGenerateSimpleProducts(
        \Magento\ConfigurableProduct\Model\Product\VariationHandler $subject,
        \Closure $proceed,
        $parentProduct,
        $productsData
    )
    {
        $this->copyVendorId($parentProduct, $subject);
        return $proceed($parentProduct, $productsData);
    }
    
}