<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * Decimal validator
 */
class DecimalValidator extends \Ecombricks\Framework\Validator\Validator
{
    
    /**
     * Precision
     * 
     * @var integer
     */
    protected $precision;
    
    /**
     * Scale
     * 
     * @var integer
     */
    protected $scale;
    
    /**
     * Float validator
     * 
     * @var \Zend_Validate_Float
     */
    protected $floatValidator;
    
    /**
     * Constructor
     * 
     * @param array $options
     * @return void
     */
    public function __construct($options = [])
    {
        parent::__construct($options);
        if (!empty($options['precision'])) {
            $this->setPrecision($options['precision']);
        }
        if (!empty($options['scale'])) {
            $this->setScale($options['scale']);
        }
    }
    
    /**
     * Get precision
     * 
     * @return integer
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getPrecision()
    {
        if (empty($this->precision)) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Precision is undefined for the decimal validator.'));
        }
        return $this->precision;
    }
    
    /**
     * Set precision
     * 
     * @param integer $precision
     * @return $this
     */
    public function setPrecision($precision)
    {
        $this->precision = $precision;
        return $this;
    }
    
    /**
     * Get scale
     * 
     * @return integer
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getScale()
    {
        if (empty($this->scale)) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Scale is undefined for the decimal validator.'));
        }
        return $this->scale;
    }
    
    /**
     * Set scale
     * 
     * @param integer $scale
     * @return $this
     */
    public function setScale($scale)
    {
        $this->scale = $scale;
        return $this;
    }
    
    /**
     * Get max value
     * 
     * @return float
     */
    protected function getMaxValue()
    {
        $value = 0;
        $precision = $this->getPrecision();
        for ($i = 0; $i < $precision; $i++) {
            $value += 9 * pow(10, $i);
        }
        $scale = $this->getScale();
        if ($scale < $precision) {
            $value *= pow(10, -1 * $scale);
        }
        return $value;
    }
    
    /**
     * Get min value
     * 
     * @return float
     */
    protected function getMinValue()
    {
        return -1 * $this->getMaxValue();
    }
    
    /**
     * Checkif float validator is set
     * 
     * @return bool
     */
    public function hasFloatValidator()
    {
        return $this->floatValidator !== null;
    }
    
    /**
     * Get float validator
     * 
     * @return \Zend_Validate_Float
     */
    public function getFloatValidator()
    {
        if ($this->floatValidator === null) {
            $validator = new \Zend_Validate_Float();
            $validator->setMessages([
                \Zend_Validate_Float::INVALID => __('%1 invalid type given.', $this->getLabelFirstLetterUppercased()),
                \Zend_Validate_Float::NOT_FLOAT => __('%1 does not appear to be a float.', $this->getLabelFirstLetterUppercased())
            ]);
            $this->floatValidator = $validator;
        }
        return $this->floatValidator;
    }
    
    /**
     * Add float validator
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addFloatValidator($value)
    {
        if ($value === null) {
            return $this;
        }
        $this->addValidator($this->getFloatValidator(), true);
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
        if ($this->hasNotEmptyValidator()) {
            $this->getNotEmptyValidator()
                ->setType(
                    \Zend_Validate_NotEmpty::ALL ^ 
                    \Zend_Validate_NotEmpty::INTEGER ^ 
                    \Zend_Validate_NotEmpty::FLOAT ^ 
                    \Zend_Validate_NotEmpty::ZERO
                );
        }
        $this->addFloatValidator($value);
        $this->addLessOrEqualValidator($value);
        if ($this->hasLessOrEqualValidator()) {
            $this->getLessOrEqualValidator()
                ->setMax($this->getMaxValue());
        }
        $this->addGreaterOrEqualValidator($value);
        if ($this->hasGreaterOrEqualValidator()) {
            $this->getGreaterOrEqualValidator()
                ->setMin($this->getMinValue());
        }
        return $this;
    }
    
}