<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Ui\DataProvider\Product\Form\Modifier;

/**
 * Vendor product form data provider modifier
 */
class Vendor extends \Ecombricks\VendorCatalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier
{
    
    /**
     * Add vendor field meta
     * 
     * @return $this
     */
    protected function addVendorFieldMeta()
    {
        $generalPanelName = $this->getGeneralPanelName($this->meta);
        if (empty($generalPanelName)) {
            return $this;
        }
        $this->setMeta(
            [
                'componentType' => \Magento\Ui\Component\Form\Field::NAME,
                'formElement' => \Magento\Ui\Component\Form\Element\Select::NAME,
                'dataType' => \Magento\Ui\Component\Form\Element\DataType\Number::NAME,
                'disableLabel' => true,
                'label' => __('Vendor'),
                'source' => $generalPanelName,
                'dataScope' => 'vendor_id',
                'sortOrder' => $this->getNextAttributeSortOrder($this->meta, [\Magento\Catalog\Api\Data\ProductAttributeInterface::CODE_STATUS], 10),
                'options' => $this->vendorManagement->getAvailableVendorOptions(false)
            ], 
            $generalPanelName.'/children/vendor_id'.static::META_CONFIG_PATH
        );
        return $this;
    }
    
    /**
     * Update related fieldset
     * 
     * @param string $dataScope
     * @return $this
     */
    protected function updateRelatedFieldset($dataScope)
    {
        $fullDataScope = $this->scopePrefix.$dataScope;
        $path = \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\Related::GROUP_RELATED.'/children/'.
            $fullDataScope.'/children/'.
            'modal/children/'.$fullDataScope.'_product_listing';
        if (!$this->hasMeta($path)) {
            return $this;
        }
        $this->setMeta('${ $.provider }:data.product.vendor_id', $path.self::META_CONFIG_PATH.'/imports/vendorId');
        $this->setMeta('${ $.externalProvider }:params.vendor', $path.self::META_CONFIG_PATH.'/exports/vendorId');
        return $this;
    }
    
    /**
     * Modify assigned data
     * 
     * @return $this
     */
    protected function modifyAssignedData()
    {
        $this->setProductAttributeValue('vendor_id', $this->getVendorId());
        return $this;
    }
    
    /**
     * Modify assigned meta
     * 
     * @return $this
     */
    protected function modifyAssignedMeta()
    {
        $this->addVendorFieldMeta();
        $this->updateRelatedFieldset(\Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\Related::DATA_SCOPE_RELATED);
        $this->updateRelatedFieldset(\Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\Related::DATA_SCOPE_UPSELL);
        $this->updateRelatedFieldset(\Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\Related::DATA_SCOPE_CROSSSELL);
        return $this;
    }

}