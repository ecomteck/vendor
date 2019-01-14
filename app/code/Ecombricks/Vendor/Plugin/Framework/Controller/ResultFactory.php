<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Plugin\Framework\Controller;

/**
 * Controller result factory plugin
 */
class ResultFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Framework\Controller\ResultFactory $subject
     * @param \Closure $proceed
     * @param string $type
     * @param array $arguments
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function aroundCreate(
        \Magento\Framework\Controller\ResultFactory $subject,
        \Closure $proceed,
        $type,
        array $arguments = []
    )
    {
        $object = $proceed($type, $arguments);
        $this
            ->setSubject($subject)
            ->setVendorId($object);
        return $object;
    }
    
}