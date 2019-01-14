<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorConfig\Block\System\Config\Form\Field;

/**
 * Config form field vendor trait
 */
trait VendorTrait
{
    
    /**
     * Check if inheritance checkbox is required
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return bool
     */
    public function vendorIsInheritCheckboxRequired(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return ((bool) $element->getVendorId()) || $this->_isInheritCheckboxRequired($element);
    }
    
    /**
     * Remove use default cell
     * 
     * @param string $html
     * @return string
     */
    public function vendorRemoveUseDefaultCell($html)
    {
        $openTag = '<td class="use-default"';
        $closeTag = '</td>';
        $openTagPos = strpos($html, $openTag);
        if ($openTagPos === false) {
            return $html;
        }
        $closeTagPos = strpos($html, $closeTag, $openTagPos);
        if ($closeTagPos === false) {
            return $html;
        }
        return substr($html, 0, $openTagPos).substr($html, $closeTagPos + strlen($closeTag));
    }
    
    /**
     * Replace inherit checkbox
     * 
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @param string $html
     * @return string
     */
    public function vendorReplaceInheritCheckbox($element, $html)
    {
        $html = $this->vendorRemoveUseDefaultCell($html);
        $newCheckboxHtml = ($this->vendorIsInheritCheckboxRequired($element)) ? $this->vendorRenderInheritCheckbox($element) : '';
        $hintPos = strpos($html, '<td class="">');
        return substr($html, 0, $hintPos).$newCheckboxHtml.substr($html, $hintPos);
    }
    
    /**
     * Get inheritance checkbox label
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function vendorGetInheritCheckboxLabel(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        if ($element->getVendorId()) {
            $checkboxLabel  = __('Use default value');
            return $checkboxLabel;
        }
        return $this->_getInheritCheckboxLabel($element);
    }
    
    /**
     * Render inheritance checkbox
     * 
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function vendorRenderInheritCheckbox(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $htmlId = $element->getHtmlId();
        $namePrefix = preg_replace('#\[value\](\[\])?$#', '', $element->getName());
        $checkedHtml = $element->getInherit() == 1 ? 'checked="checked"' : '';
        $disabled = $element->getIsDisableInheritance() == true ? ' disabled="disabled"' : '';
        $html = '<td class="use-default">';
        $html .= '<input id="'.$htmlId.'_inherit" name="'.$namePrefix.'[inherit]" type="checkbox" value="1" class="checkbox config-inherit" '.$checkedHtml.$disabled.' '.
            'onclick="toggleValueElements(this, Element.previous(this.parentNode))" /> ';
        $html .= '<label for="'.$htmlId.'_inherit" class="inherit">'.$this->vendorGetInheritCheckboxLabel($element).'</label>';
        $html .= '</td>';
        return $html;
    }
    
}