<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorBundle\Ui\DataProvider\Product\Form\Modifier;

/**
 * Vendor bundle product form data provider modifier
 */
class Vendor extends \Ecombricks\VendorCatalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier
{
    
    /**
     * Update bundle fieldset
     * 
     * @return $this
     */
    protected function updateBundleFieldset()
    {
        if ($this->getProductTypeId() != \Magento\Bundle\Model\Product\Type::TYPE_CODE) {
            return $this;
        }
        $path = \Magento\Bundle\Ui\DataProvider\Product\Form\Modifier\BundlePanel::CODE_BUNDLE_DATA.'/children/'.
            'modal/children/bundle_product_listing';
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
        $this->updateBundleFieldset();
        return $this;
    }
    
}