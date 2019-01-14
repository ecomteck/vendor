<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Model\Vendor;

/**
 * Vendor validator
 */
class Validator extends \Ecombricks\Framework\Model\Validator
{
    
    /**
     * Add validators
     * 
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function addValidators($object)
    {
        parent::addValidators($object);
        $this
            ->addValidator('is_active', new \Ecombricks\Framework\Validator\BooleanValidator([
                'label' => __('is enabled'),
                'required' => false
            ]))
            ->addValidator('code', new \Ecombricks\Framework\Validator\CodeValidator([
                'number_first_character_allowed' => true,
                'object' => $object,
                'object_label' => __('vendor'),
                'required' => true
            ]))
            ->addValidator('name', new \Ecombricks\Framework\Validator\NameValidator([
                'object' => $object,
                'object_label' => __('vendor'),
                'required' => true
            ]))
            ->addValidator('short_description', new \Ecombricks\Framework\Validator\TextValidator([
                'label' => 'short description',
                'required' => false
            ]))
            ->addValidator('description', new \Ecombricks\Framework\Validator\TextValidator([
                'label' => 'description',
                'required' => false
            ]))
            ->addValidator('meta_title', new \Ecombricks\Framework\Validator\StringValidator([
                'label' => 'meta title',
                'required' => false
            ]))
            ->addValidator('meta_keywords', new \Ecombricks\Framework\Validator\TextValidator([
                'label' => 'meta keywords',
                'required' => false
            ]))
            ->addValidator('meta_description', new \Ecombricks\Framework\Validator\TextValidator([
                'label' => 'meta description',
                'required' => false
            ]));
        return $this;
    }
    
}