<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Plugin\Model;

/**
 * Product model factory plugin
 */
class ProductFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Catalog\Model\ProductFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Catalog\Model\Product
     */
    public function aroundCreate(
        \Magento\Catalog\Model\ProductFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}