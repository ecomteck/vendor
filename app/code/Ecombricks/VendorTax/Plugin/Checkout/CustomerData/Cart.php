<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorTax\Plugin\Checkout\CustomerData;

/**
 * Cart customer data tax plugin
 */
class Cart extends \Magento\Tax\Plugin\Checkout\CustomerData\Cart
{
    
    /**
     * Get totals
     *
     * @return array
     */
    public function getTotals()
    {
        $this->totals = null;
        return parent::getTotals();
    }
    
    /**
     * Get quote
     *
     * @return \Magento\Quote\Model\Quote
     */
    protected function getQuote()
    {
        $this->quote = null;
        return parent::getQuote();
    }
    
}