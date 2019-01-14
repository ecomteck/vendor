<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model;

/**
 * Quote repository model plugin
 */
class QuoteRepository
{
    
    /**
     * Around get for customer
     * 
     * @param \Magento\Quote\Model\QuoteRepository $subject
     * @param \Closure $proceed
     * @param int $customerId
     * @param int[] $sharedStoreIds
     * @return \Magento\Quote\Api\Data\CartInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function aroundGetForCustomer(
        \Magento\Quote\Model\QuoteRepository $subject, 
        \Closure $proceed, 
        $customerId, 
        array $sharedStoreIds = []
    )
    {
        return $subject->vendorGetForCustomer($customerId, $sharedStoreIds);
    }
    
}