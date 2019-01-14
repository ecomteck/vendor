<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Block\Adminhtml\Order\Create\Form;

/**
 * Create order form vendor trait
 */
trait VendorTrait
{
    
    /**
     * After get order data JSON
     * 
     * @param string $encodedData
     * @return array
     */
    public function vendorAfterGetOrderDataJson($encodedData)
    {
        $data = $this->vendorJsonDecoder->decode($encodedData);
        $data['vendor'] = $this->getVendorId();
        return $this->_jsonEncoder->encode($data);
    }
    
}