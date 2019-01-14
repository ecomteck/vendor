<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfig\Plugin\App\Config\Source;

/**
 * Runtime config source plugin
 */
class RuntimeConfigSource
{

    /**
     * Around get
     *
     * @param \Magento\Config\App\Config\Source\RuntimeConfigSource $subject
     * @param \Closure $proceed
     * @param string $path
     * @return array
     */
    public function aroundGet(
        \Magento\Config\App\Config\Source\RuntimeConfigSource $subject,
        \Closure $proceed,
        $path
    )
    {
        return $subject->vendorGet($path);
    }

}