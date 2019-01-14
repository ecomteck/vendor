<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Plugin\Framework\Url;

/**
 * URL route params resolver factory plugin
 */
class RouteParamsResolverFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Framework\Url\RouteParamsResolverFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Framework\Url\RouteParamsResolver
     */
    public function aroundCreate(
        \Magento\Framework\Url\RouteParamsResolverFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}