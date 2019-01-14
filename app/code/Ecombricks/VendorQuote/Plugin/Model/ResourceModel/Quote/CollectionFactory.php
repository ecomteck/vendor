<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\ResourceModel\Quote;

/**
 * Quote collection factory plugin
 */
class CollectionFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Quote\Model\ResourceModel\Quote\CollectionFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Quote\Model\ResourceModel\Quote\Collection
     */
    public function aroundCreate(
        \Magento\Quote\Model\ResourceModel\Quote\CollectionFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}