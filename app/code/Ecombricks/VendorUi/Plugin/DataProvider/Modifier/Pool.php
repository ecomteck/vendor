<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorUi\Plugin\DataProvider\Modifier;

/**
 * Modifier pool plugin
 */
class Pool extends \Ecombricks\Vendor\Framework\Plugin\AbstractPlugin
{
    
    /**
     * Around get modifiers instances
     * 
     * @param \Magento\Ui\DataProvider\Modifier\Pool $subject
     * @param \Closure $proceed
     * @return \Magento\Ui\DataProvider\Modifier\ModifierInterface
     */
    public function aroundGetModifiersInstances(
        \Magento\Ui\DataProvider\Modifier\Pool $subject,
        \Closure $proceed
    )
    {
        $modifierInstances = $proceed();
        if (empty($modifierInstances)) {
            return $modifierInstances;
        }
        $this->setSubject($subject);
        foreach ($modifierInstances as $modifierInstance) {
            $this->setVendorId($modifierInstance);
        }
        return $modifierInstances;
    }
    
}