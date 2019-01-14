<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * String validator
 */
class StringValidator extends \Ecombricks\Framework\Validator\Validator
{
    
    /**
     * Min length
     * 
     * @var int
     */
    protected $minLength;
    
    /**
     * Max length
     * 
     * @var int
     */
    protected $maxLength;
    
    /**
     * String length validator
     * 
     * @var \Zend_Validate_StringLength
     */
    protected $stringLengthValidator;
    
    /**
     * Regex validator
     * 
     * @var \Zend_Validate_Regex
     */
    protected $regexValidator;
    
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
     * Initialize
     * 
     * @return $this
     */
    public function _construct()
    {
        parent::_construct();
        $this->setMaxLength(255);
        return $this;
    }
    
    /**
     * Get min length
     * 
     * @return int
     */
    public function getMinLength()
    {
        return $this->minLength;
    }
    
    /**
     * Set min length
     * 
     * @param int $minLength
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
     * @return int
     */
    public function getMaxLength()
    {
        return $this->maxLength;
    }
    
    /**
     * Set max length
     * 
     * @param int $maxLength
     * @return $this
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
        return $this;
    }
    
    /**
     * Checkif string length validator is set
     * 
     * @return bool
     */
    public function hasStringLengthValidator()
    {
        return $this->stringLengthValidator !== null;
    }
    
    /**
     * Get string length validator
     * 
     * @return \Zend_Validate_StringLength
     */
    public function getStringLengthValidator()
    {
        if ($this->stringLengthValidator === null) {
            $validator = new \Zend_Validate_StringLength();
            $validator->setMessages([
                \Zend_Validate_StringLength::INVALID => __('%1 invalid type given.', $this->getLabelFirstLetterUppercased()),
                \Zend_Validate_StringLength::TOO_SHORT => __('%1 is less than %min% characters long.', $this->getLabelFirstLetterUppercased()),
                \Zend_Validate_StringLength::TOO_LONG => __('%1 is more than %max% characters long.', $this->getLabelFirstLetterUppercased())
            ]);
            $this->stringLengthValidator = $validator;
        }
        return $this->stringLengthValidator;
    }
    
    /**
     * Add string length validator
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addStringLengthValidator($value)
    {
        if ($value === null) {
            return $this;
        }
        $this->addValidator($this->getStringLengthValidator(), true);
        return $this;
    }
    
    /**
     * Checkif regex validator is set
     * 
     * @return bool
     */
    public function hasRegexValidator()
    {
        return $this->regexValidator !== null;
    }
    
    /**
     * Get regex validator
     * 
     * @return \Zend_Validate_StringLength
     */
    public function getRegexValidator()
    {
        if ($this->regexValidator === null) {
            $validator = new \Zend_Validate_Regex(['pattern' => '/^\w*$/']);
            $validator->setMessages([
                \Zend_Validate_Regex::INVALID => __('%1 invalid type given.', $this->getLabelFirstLetterUppercased()),
                \Zend_Validate_Regex::NOT_MATCH => __('%1 does not match against pattern.', $this->getLabelFirstLetterUppercased())
            ]);
            $this->regexValidator = $validator;
        }
        return $this->regexValidator;
    }
    
    /**
     * Add regex validator
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addRegexValidator($value)
    {
        if ($value === null) {
            return $this;
        }
        $this->addValidator($this->getRegexValidator(), true);
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
        $this->addStringLengthValidator($value);
        if (!$this->hasStringLengthValidator()) {
            return $this;
        }
        $stringLengthValidator = $this->getStringLengthValidator();
        $minLength = $this->getMinLength();
        if ($minLength !== null) {
            $stringLengthValidator->setMin($minLength);
        }
        $maxLength = $this->getMaxLength();
        if ($maxLength !== null) {
            $stringLengthValidator->setMax($maxLength);
        }
        return $this;
    }
    
}