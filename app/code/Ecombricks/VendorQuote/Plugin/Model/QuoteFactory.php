<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model;

/**
 * Quote model factory plugin
 */
class QuoteFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Quote\Model\QuoteFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Quote\Model\Quote
     */
    public function aroundCreate(
        \Magento\Quote\Model\QuoteFactory $subject,
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