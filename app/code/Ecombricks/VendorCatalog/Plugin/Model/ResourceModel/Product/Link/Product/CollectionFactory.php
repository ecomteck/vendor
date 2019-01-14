<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Plugin\Model\ResourceModel\Product\Link\Product;

/**
 * Product link product collection factory plugin
 */
class CollectionFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Catalog\Model\ResourceModel\Product\Link\Product\CollectionFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Catalog\Model\ResourceModel\Product\Link\Product\Collection
     */
    public function aroundCreate(
        \Magento\Catalog\Model\ResourceModel\Product\Link\Product\CollectionFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}