<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * Select validator
 */
class SelectValidator extends \Ecombricks\Framework\Validator\IntegerValidator
{
    
    /**
     * Values
     * 
     * @var array
     */
    protected $values;
    
    /**
     * Constructor
     * 
     * @param array $options
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function __construct($options = [])
    {
        if (!isset($options['values']) || !is_array($options['values'])) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Values are required for the select validator.')
            );
        }
        $this->setValues($options['values']);
        parent::__construct($options);
    }
    
    /**
     * Get values
     * 
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }
    
    /**
     * Set values
     * 
     * @param array $values
     * @return $this
     */
    public function setValues($values)
    {
        $this->values = $values;
        return $this;
    }
    
    /**
     * Add validators
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addValidators($value)
    {
        parent::addValidators($value);
        $this->addInArrayValidator($value);
        if ($this->hasInArrayValidator()) {
            $this->getInArrayValidator()
                ->setMessage(__('%1 is invalid.', $this->getLabelFirstLetterUppercased()), \Zend_Validate_InArray::NOT_IN_ARRAY)
                ->setHaystack($this->getValues());
        }
        return $this;
    }
    
}