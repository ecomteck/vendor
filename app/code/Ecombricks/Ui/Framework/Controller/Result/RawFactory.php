<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Ui\Framework\Controller\Result;

/**
 * Raw controller result factory
 */
class RawFactory extends \Magento\Framework\Controller\Result\RawFactory
{
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @return void
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        $instanceName = \Ecombricks\Ui\Framework\Controller\Result\Raw::class
    )
    {
        parent::__construct($objectManager, $instanceName);
    }
    
}