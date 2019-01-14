<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\Quote\Address\Total;

/**
 * Quote address total collector factory plugin
 */
class CollectorFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Quote\Model\Quote\Address\Total\CollectorFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Quote\Model\Quote\Address\Total\Collector
     */
    public function aroundCreate(
        \Magento\Quote\Model\Quote\Address\Total\CollectorFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        $result = $proceed($data);
        $this
            ->setSubject($subject)
            ->setVendorId($result);
        return $result;
    }
    
}