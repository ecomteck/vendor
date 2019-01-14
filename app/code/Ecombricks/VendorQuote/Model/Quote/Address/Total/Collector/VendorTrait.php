<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model\Quote\Address\Total\Collector;

/**
 * Quote address total collector vendor trait
 */
trait VendorTrait
{
    
    /**
     * Initialize retrievers
     * 
     * @return $this
     */
    public function vendorInitRetrievers()
    {
        $sorts = $this->_scopeConfig->getValue(self::XML_PATH_SALES_TOTALS_SORT, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $this->_store);
        foreach ($sorts as $code => $sortOrder) {
            if (!isset($this->_models[$code])) {
                continue;
            }
            $retrieverId = 100 * (int) $sortOrder;
            while (isset($this->_retrievers[$retrieverId])) {
                $retrieverId++;
            }
            $this->_retrievers[$retrieverId] = $this->_models[$code];
        }
        ksort($this->_retrievers);
        $notSorted = array_diff(array_keys($this->_models), array_keys($sorts));
        foreach ($notSorted as $code) {
            $this->_retrievers[] = $this->_models[$code];
        }
        return $this;
    }
    
    /**
     * After set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function afterSetVendorId($vendorId)
    {
        $this->_initModels()
            ->_initCollectors()
            ->vendorInitRetrievers();
        return $this;
    }
    
}