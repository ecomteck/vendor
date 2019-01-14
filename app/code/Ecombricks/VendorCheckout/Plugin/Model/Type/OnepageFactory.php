<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Plugin\Model\Type;

/**
 * Onepage checkout model factory plugin
 */
class OnepageFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Checkout\Model\Type\OnepageFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Checkout\Model\Type\Onepage
     */
    public function aroundCreate(
        \Magento\Checkout\Model\Type\OnepageFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}