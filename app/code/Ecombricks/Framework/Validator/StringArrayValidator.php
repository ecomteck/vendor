<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * String array validator
 */
class StringArrayValidator extends \Ecombricks\Framework\Validator\Validator
{
    
    /**
     * Min length
     * 
     * @var integer
     */
    protected $minLength;
    
    /**
     * Max length
     * 
     * @var integer
     */
    protected $maxLength;
    
    /**
     * Constructor
     * 
     * @param array $options
     * @return void
     */
    public function __construct($options = [])
    {
        parent::__construct($options);
        if (!empty($options['min_length'])) {
            $this->setMinLength($options['min_length']);
        }
        if (!empty($options['max_length'])) {
            $this->setMaxLength($options['max_length']);
        }
    }
    
    /**
     * Get min length
     * 
     * @return integer
     */
    public function getMinLength()
    {
        return $this->minLength;
    }
    
    /**
     * Set min length
     * 
     * @param integer $minLength
     * @return $this
     */
    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;
        return $this;
    }
    
    /**
     * Get max length
     * 
     * @return integer
     */
    public function getMaxLength()
    {
        return $this->maxLength;
    }
    
    /**
     * Set max length
     * 
     * @param integer $maxLength
     * @return $this
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
        return $this;
    }
    
    /**
     * Get array item validator
     * 
     * @return bool
     */
    public function getArrayItemValidator()
    {
        return new \Ecombricks\Framework\Validator\StringValidator([
            'label' => $this->getLabel(),
            'required' => $this->getIsRequired(),
            'min_length' => $this->getMinLength(),
            'max_length' => $this->getMaxLength()
        ]);
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
        $this->addArrayValidator($value);
        return $this;
    }
    
}