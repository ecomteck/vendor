<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Plugin\Framework\App\Action;

/**
 * Action plugin
 */
class Action
{
    
    /**
     * Around dispatch
     * 
     * @param \Magento\Framework\App\Action\Action $subject
     * @param \Closure $proceed
     * @param \Magento\Framework\App\RequestInterface $request
     * @return void
     */
    public function aroundDispatch(
        \Magento\Framework\App\Action\Action $subject,
        \Closure $proceed,
        \Magento\Framework\App\RequestInterface $request
    )
    {
        $subject->vendorBeforeDispatch($request);
        return $proceed($request);
    }
    
    /**
     * Around execute
     * 
     * @param \Magento\Framework\App\Action\Action $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Controller\AbstractResult
     */
    public function aroundExecute(
        \Magento\Framework\App\Action\Action $subject,
        \Closure $proceed
    )
    {
        $subject->vendorBeforeExecute();
        return $proceed();
    }
    
}