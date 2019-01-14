<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Plugin\Framework\View\Result;

/**
 * Page view result factory plugin
 */
class PageFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Framework\View\Result\PageFactory $subject
     * @param \Closure $proceed
     * @param bool $isView
     * @param array $arguments
     * @return \Magento\Framework\View\Result\Page
     */
    public function aroundCreate(
        \Magento\Framework\View\Result\PageFactory $subject,
        \Closure $proceed,
        $isView = false,
        array $arguments = []
    )
    {
        $object = $proceed($isView, $arguments);
        $this
            ->setSubject($subject)
            ->setVendorId($object, false);
        return $object;
    }
    
}