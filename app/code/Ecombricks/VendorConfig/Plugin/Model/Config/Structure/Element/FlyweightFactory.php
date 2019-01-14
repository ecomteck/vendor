<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfig\Plugin\Model\Config\Structure\Element;

/**
 * Config structure element flyweight factory model plugin
 */
class FlyweightFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Config\Model\Config\Structure\Element\FlyweightFactory $subject
     * @param \Closure $proceed
     * @param string $type
     * @return \Magento\Config\Model\Config\Structure\ElementInterface
     */
    public function aroundCreate(
        \Magento\Config\Model\Config\Structure\Element\FlyweightFactory $subject,
        \Closure $proceed,
        $type
    )
    {
        $object = $proceed($type);
        $this
            ->setSubject($subject)
            ->setVendorId($object, false);
        return $object;
    }
    
}