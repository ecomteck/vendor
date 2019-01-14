<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Plugin\Framework\View\Result;

/**
 * Layout view result factory plugin
 */
class LayoutFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Framework\View\Result\LayoutFactory $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\View\Result\Layout
     */
    public function aroundCreate(
        \Magento\Framework\View\Result\LayoutFactory $subject,
        \Closure $proceed
    )
    {
        $object = $proceed();
        $this
            ->setSubject($subject)
            ->setVendorId($object, false);
        return $object;
    }
    
}