<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfig\Plugin\Block\System\Config\Form;

/**
 * Config form field plugin
 */
class Field
{
    
    /**
     * Around render
     * 
     * @param \Magento\Config\Block\System\Config\Form\Field $subject
     * @param \Closure $proceed
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function aroundRender(
        \Magento\Config\Block\System\Config\Form\Field $subject,
        \Closure $proceed,
        \Magento\Framework\Data\Form\Element\AbstractElement $element
    )
    {
        $isCheckboxRequired = $subject->vendorIsInheritCheckboxRequired($element);
        if ($element->getInherit() == 1 && $isCheckboxRequired) {
            $element->setDisabled(true);
        }
        return $subject->vendorReplaceInheritCheckbox($element, $proceed($element));
    }
    
}