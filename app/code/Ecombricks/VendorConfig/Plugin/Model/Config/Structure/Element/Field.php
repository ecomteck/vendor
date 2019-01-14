<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfig\Plugin\Model\Config\Structure\Element;

/**
 * Field config structure element model plugin
 */
class Field extends \Ecombricks\Vendor\Framework\Plugin\AbstractPlugin
{
    
    /**
     * Around populate input
     * 
     * @param \Magento\Config\Model\Config\Structure\Element\Field $subject
     * @param \Closure $proceed
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $formField
     * @return void
     */
    public function aroundPopulateInput(
        \Magento\Config\Model\Config\Structure\Element\Field $subject,
        \Closure $proceed,
        $formField
    )
    {
        $formField->setVendorId($subject->getVendorId());
        $proceed($formField);
    }    
    
}