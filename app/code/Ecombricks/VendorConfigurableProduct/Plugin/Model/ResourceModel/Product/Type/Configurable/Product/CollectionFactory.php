<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfigurableProduct\Plugin\Model\ResourceModel\Product\Type\Configurable\Product;

/**
 * Configurable product collection factory plugin
 */
class CollectionFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable\Product\CollectionFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable\Product\Collection
     */
    public function aroundCreate(
        \Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable\Product\CollectionFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}