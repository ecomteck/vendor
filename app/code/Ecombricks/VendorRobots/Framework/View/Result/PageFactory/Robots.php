<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorRobots\Framework\View\Result\PageFactory;

/**
 * Robots result page factory
 */
class Robots extends \Magento\Framework\View\Result\PageFactory
{
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @return void
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager
    )
    {
        $instanceName = \Ecombricks\VendorRobots\Framework\View\Result\Page\Robots::class;
        parent::__construct(
            $objectManager,
            $instanceName
        );
    }
    
}