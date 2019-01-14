<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfigurableProduct\Ui\DataProvider\Product\Form\Modifier;

/**
 * Vendor configurable product form data provider modifier
 */
class Vendor extends \Ecombricks\VendorCatalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier
{
    
    /**
     * Update configurable fieldset
     * 
     * @return $this
     */
    protected function updateConfigurableFieldset()
    {
        if ($this->getProductTypeId() != \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE) {
            return $this;
        }
        $path = \Magento\ConfigurableProduct\Ui\DataProvider\Product\Form\Modifier\ConfigurablePanel::ASSOCIATED_PRODUCT_MODAL.'/children/'.
            \Magento\ConfigurableProduct\Ui\DataProvider\Product\Form\Modifier\ConfigurablePanel::ASSOCIATED_PRODUCT_LISTING;
        if (!$this->hasMeta($path)) {
            return $this;
        }
        $this->setMeta('${ $.provider }:data.product.vendor_id', $path.self::META_CONFIG_PATH.'/imports/vendorId');
        $this->setMeta('${ $.externalProvider }:params.vendor', $path.self::META_CONFIG_PATH.'/exports/vendorId');
        return $this;
    }
    
    /**
     * Modify assigned meta
     * 
     * @return $this
     */
    protected function modifyAssignedMeta()
    {
        $this->updateConfigurableFieldset();
        return $this;
    }
    
}