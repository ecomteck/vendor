<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\Quote\Address;

/**
 * Quote address rate collector interface model factory plugin
 */
class RateCollectorInterfaceFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Quote\Model\Quote\Address\RateCollectorInterfaceFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Quote\Model\Quote\Address\RateCollectorInterface
     */
    public function aroundCreate(
        \Magento\Quote\Model\Quote\Address\RateCollectorInterfaceFactory $subject,
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