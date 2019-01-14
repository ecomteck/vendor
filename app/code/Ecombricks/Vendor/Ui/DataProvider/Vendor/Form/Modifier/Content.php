<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Ui\DataProvider\Vendor\Form\Modifier;

/**
 * Vendor form data provider content modifier
 */
class Content extends \Ecombricks\Vendor\Ui\DataProvider\Vendor\Form\Modifier\AbstractModifier
{
    
    /**
     * Modify assigned data
     * 
     * @return $this
     */
    protected function modifyAssignedData()
    {
        $this
            ->setVendorFieldValue('short_description')
            ->setVendorFieldValue('description');
        return $this;
    }
    
    /**
     * Modify assigned meta
     * 
     * @return $this
     */
    protected function modifyAssignedMeta()
    {
        $fieldsetCode = 'content';
        $children = [
            static::CONTAINER_PREFIX.'short_description' => $this->createFieldContainerMeta(
                'short_description',
                [
                    'dataType' => \Magento\Ui\Component\Form\Element\DataType\Text::NAME,
                    'formElement' => \Magento\Ui\Component\Form\Element\Wysiwyg::NAME,
                    'wysiwyg' => true,
                    'wysiwygConfigData' => [
                        'add_variables' => false,
                        'add_widgets' => false,
                        'add_directives' => true,
                        'use_container' => true,
                        'container_class' => 'hor-scroll'
                    ],
                    'required' => false,
                    'label' => __('Short Description'),
                    'source' => $fieldsetCode,
                    'validation' => [
                        'required-entry' => false
                    ],
                    'sortOrder' => 50
                ],
                [
                    'component' => 'Magento_Ui/js/form/components/group'
                ]
            ),
            static::CONTAINER_PREFIX.'description' => $this->createFieldContainerMeta(
                'description',
                [
                    'dataType' => \Magento\Ui\Component\Form\Element\DataType\Text::NAME,
                    'formElement' => \Magento\Ui\Component\Form\Element\Wysiwyg::NAME,
                    'wysiwyg' => true,
                    'wysiwygConfigData' => [
                        'add_variables' => false,
                        'add_widgets' => false,
                        'add_directives' => true,
                        'use_container' => true,
                        'container_class' => 'hor-scroll'
                    ],
                    'required' => false,
                    'label' => __('Description'),
                    'source' => $fieldsetCode,
                    'validation' => [
                        'required-entry' => false
                    ],
                    'sortOrder' => 60
                ],
                [
                    'component' => 'Magento_Ui/js/form/components/group'
                ]
            )
        ];
        $this->setMeta(
            $this->createFieldsetMeta(
                [
                    'label' => __('Content'),
                    'collapsible' => true,
                    'opened' => false,
                    'dataScope' => static::DATA_SCOPE_VENDOR,
                    'sortOrder' => 20
                ],
                $children
            ),
            $fieldsetCode
        );
        return $this;
    }
    
}