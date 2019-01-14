<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Ui\DataProvider\Vendor\Form\Modifier;

/**
 * Vendor form data provider search engine optimization modifier
 */
class SearchEngineOptimization extends \Ecombricks\Vendor\Ui\DataProvider\Vendor\Form\Modifier\AbstractModifier
{
    
    /**
     * Modify assigned data
     * 
     * @return $this
     */
    protected function modifyAssignedData()
    {
        $this
            ->setVendorFieldValue('meta_title')
            ->setVendorFieldValue('meta_keywords')
            ->setVendorFieldValue('meta_description');
        return $this;
    }
    
    /**
     * Modify assigned meta
     * 
     * @return $this
     */
    protected function modifyAssignedMeta()
    {
        $fieldsetCode = 'search_engine_optimization';
        $children = [
            static::CONTAINER_PREFIX.'meta_title' => $this->createFieldContainerMeta(
                'meta_title',
                [
                    'dataType' => \Magento\Ui\Component\Form\Element\DataType\Text::NAME,
                    'formElement' => \Magento\Ui\Component\Form\Element\Input::NAME,
                    'required' => false,
                    'label' => __('Meta Title'),
                    'source' => $fieldsetCode,
                    'validation' => [
                        'required-entry' => false
                    ],
                    'sortOrder' => 70
                ]
            ),
            static::CONTAINER_PREFIX.'meta_keywords' => $this->createFieldContainerMeta(
                'meta_keywords',
                [
                    'dataType' => \Magento\Ui\Component\Form\Element\DataType\Text::NAME,
                    'formElement' => \Magento\Ui\Component\Form\Element\Textarea::NAME,
                    'required' => false,
                    'label' => __('Meta Keywords'),
                    'source' => $fieldsetCode,
                    'validation' => [
                        'required-entry' => false
                    ],
                    'sortOrder' => 80
                ]
            ),
            static::CONTAINER_PREFIX.'meta_description' => $this->createFieldContainerMeta(
                'meta_description',
                [
                    'dataType' => \Magento\Ui\Component\Form\Element\DataType\Text::NAME,
                    'formElement' => \Magento\Ui\Component\Form\Element\Textarea::NAME,
                    'required' => false,
                    'label' => __('Meta Description'),
                    'source' => $fieldsetCode,
                    'validation' => [
                        'required-entry' => false
                    ],
                    'sortOrder' => 90
                ]
            )
        ];
        $this->setMeta(
            $this->createFieldsetMeta(
                [
                    'label' => __('Search Engine Optimization'),
                    'collapsible' => true,
                    'opened' => false,
                    'dataScope' => static::DATA_SCOPE_VENDOR,
                    'sortOrder' => 30
                ],
                $children
            ),
            $fieldsetCode
        );
        return $this;
    }
    
}