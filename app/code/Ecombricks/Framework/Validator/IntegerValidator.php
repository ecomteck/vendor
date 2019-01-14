<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * Integer validator
 */
class IntegerValidator extends \Ecombricks\Framework\Validator\Validator
{
    
    /**
     * Types
     */
    const TYPE_TINYINT = 'tinyint';
    const TYPE_SMALLINT = 'smallint';
    const TYPE_MEDIUMINT = 'mediumint';
    const TYPE_INT = 'int';
    const TYPE_BIGINT = 'bigint';
    
    /**
     * Type
     * 
     * @var string
     */
    protected $type = self::TYPE_INT;
    
    /**
     * Unsigned flag
     * 
     * @var bool
     */
    protected $unsigned = false;
    
    /**
     * Integer validator
     * 
     * @var \Zend_Validate_Int
     */
    protected $intValidator;
    
    /**
     * Constructor
     * 
     * @param array $options
     * @return void
     */
    public function __construct($options = [])
    {
        parent::__construct($options);
        if (!empty($options['type'])) {
            $this->setType($options['type']);
        }
        if (array_key_exists('unsigned', $options)) {
            $this->setUnsigned($options['unsigned']);
        }
    }
    
    /**
     * Get type
     * 
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Set type
     * 
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    /**
     * Get unsigned
     * 
     * @return bool
     */
    public function getUnsigned()
    {
        return $this->unsigned;
    }
    
    /**
     * Set unsigned
     * 
     * @param bool $unsigned
     * @return $this
     */
    public function setUnsigned($unsigned)
    {
        $this->unsigned = $unsigned;
        return $this;
    }
    
    /**
     * Check if is unsigned
     * 
     * @return bool
     */
    public function isUnsigned()
    {
        return $this->getUnsigned();
    }
    
    /**
     * Get min value
     * 
     * @return int
     */
    public function getMinValue()
    {
        if ($this->isUnsigned()) {
            return 0;
        }
        switch ($this->getType()) {
            case self::TYPE_TINYINT : 
                $value = -128;
                break;
            case self::TYPE_SMALLINT : 
                $value = -32768;
                break;
            case self::TYPE_MEDIUMINT : 
                $value = -8388608;
                break;
            case self::TYPE_INT : 
                $value = -2147483648;
                break;
            case self::TYPE_BIGINT : 
                $value = -9223372036854775808;
                break;
            default: 
                $value = -2147483648;
                break;
        }
        return $value;
    }
    
    /**
     * Get max value
     * 
     * @return int
     */
    public function getMaxValue()
    {
        $unsigned = $this->isUnsigned();
        switch ($this->getType()) {
            case self::TYPE_TINYINT : 
                $value = ($unsigned) ? 255 : 127;
                break;
            case self::TYPE_SMALLINT : 
                $value = ($unsigned) ? 65535 : 32767;
                break;
            case self::TYPE_MEDIUMINT : 
                $value = ($unsigned) ? 16777215 : 8388607;
                break;
            case self::TYPE_INT : 
                $value = ($unsigned) ? 4294967295 : 2147483647;
                break;
            case self::TYPE_BIGINT : 
                $value = ($unsigned) ? 18446744073709551615 : 9223372036854775807;
                break;
            default: 
                $value = ($unsigned) ? 4294967295 : 2147483647;
                break;
        }
        return $value;
    }
    
    /**
     * Checkif integer validator is set
     * 
     * @return bool
     */
    public function hasIntValidator()
    {
        return $this->intValidator !== null;
    }
    
    /**
     * Get integer validator
     * 
     * @return \Zend_Validate_Int
     */
    public function getIntValidator()
    {
        if ($this->intValidator === null) {
            $validator = new \Zend_Validate_Int();
            $validator->setMessages([
                \Zend_Validate_Int::INVALID => __('%1 invalid type given.', $this->getLabelFirstLetterUppercased()),
                \Zend_Validate_Int::NOT_INT => __('%1 does not appear to be an integer.', $this->getLabelFirstLetterUppercased())
            ]);
            $this->intValidator = $validator;
        }
        return $this->intValidator;
    }
    
    /**
     * Add integer validator
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addIntValidator($value)
    {
        if ($value === null) {
            return $this;
        }
        $this->addValidator($this->getIntValidator(), true);
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
                    \Zend_Validate_NotEmpty::ZERO
                );
        }
        $this->addIntValidator($value);
        $this->addGreaterOrEqualValidator($value);
        if ($this->hasGreaterOrEqualValidator()) {
            $this->getGreaterOrEqualValidator()
                ->setMin($this->getMinValue());
        }
        $this->addLessOrEqualValidator($value);
        if ($this->hasLessOrEqualValidator()) {
            $this->getLessOrEqualValidator()
                ->setMax($this->getMaxValue());
        }
        return $this;
    }
    
}