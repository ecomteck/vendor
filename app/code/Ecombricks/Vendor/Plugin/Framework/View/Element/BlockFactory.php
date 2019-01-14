<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Plugin\Framework\View\Element;

/**
 * Block factory plugin
 */
class BlockFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create block
     * 
     * @param \Magento\Framework\View\Element\BlockFactory $subject
     * @param \Closure $proceed
     * @param string $blockName
     * @param array $arguments
     * @return \Magento\Framework\View\Element\BlockInterface
     * @throws \LogicException
     */
    public function aroundCreateBlock(
        \Magento\Framework\View\Element\BlockFactory $subject,
        \Closure $proceed,
        $blockName,
        array $arguments = []
    )
    {
        $object = $proceed($blockName, $arguments);
        $this
            ->setSubject($subject)
            ->setVendorId($object);
        return $object;
    }
    
}