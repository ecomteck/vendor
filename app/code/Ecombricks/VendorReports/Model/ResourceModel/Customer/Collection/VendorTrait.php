<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorReports\Model\ResourceModel\Customer\Collection;

/**
 * Reports customer collection model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Add cart info
     * 
     * @return $this
     */
    public function vendorAddCartInfo()
    {
        foreach ($this->getItems() as $customer) {
            try {
                $vendorIds = $this->quoteRepository->getVendorIdsForCustomer($customer->getId());
                $total = 0;
                $items = 0;
                foreach ($vendorIds as $vendorId) {
                    $this->quoteRepository->setVendorId($vendorId);
                    $quote = $this->quoteRepository->getForCustomer($customer->getId());
                    $quoteTotals = $quote->getTotals();
                    $total += $quoteTotals['subtotal']->getValue();
                    $quoteItems = $this->_quoteItemFactory->create()->setQuoteFilter($quote->getId());
                    $quoteItems->load();
                    $items += $quoteItems->count();
                }
                $customer->setTotal($total);
                $customer->setItems($items);
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                $customer->remove();
            }
        }
        return $this;
    }
    
}