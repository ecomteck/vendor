<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorGroupedProduct\Ui\DataProvider\Product\Form\Modifier;

/**
 * Vendor grouped product form data provider modifier
 */
class Vendor extends \Ecombricks\VendorCatalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier
{
    
    /**
     * Update grouped fieldset
     * 
     * @return $this
     */
    protected function updateGroupedFieldset()
    {
        if ($this->getProductTypeId() != \Magento\GroupedProduct\Model\Product\Type\Grouped::TYPE_CODE) {
            return $this;
        }
        $path = \Magento\GroupedProduct\Ui\DataProvider\Product\Form\Modifier\Grouped::GROUP_GROUPED.'/children/grouped_products_modal';
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
        $this->updateGroupedFieldset();
        return $this;
    }
    
}