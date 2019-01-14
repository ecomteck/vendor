<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfig\Plugin\Framework\App\Config;

/**
 * Config value factory plugin
 */
class ValueFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Framework\App\Config\ValueFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Framework\App\Config\ValueInterface
     */
    public function aroundCreate(
        \Magento\Framework\App\Config\ValueFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}