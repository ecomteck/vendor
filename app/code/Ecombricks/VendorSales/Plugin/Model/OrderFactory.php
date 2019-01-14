<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model;

/**
 * Order model factory plugin
 */
class OrderFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Sales\Model\OrderFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Sales\Model\Order
     */
    public function aroundCreate(
        \Magento\Sales\Model\OrderFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}