<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator\Plain;

/**
 * Array plain validator
 */
class ArrayValidator extends \Zend_Validate_Abstract
{
    
    /**
     * Constants
     */
    const INVALID = 'invalid';
    const INVALID_ITEM = 'invalidItem';
    
    /**
     * @var array
     */
    protected $_messageTemplates = [
        self::INVALID => 'Invalid type given. Array expected.',
        self::INVALID_ITEM => 'Array contains invalid items.'
    ];
    
    /**
     * Item validator
     *
     * @var \Zend_Validate_Abstract
     */
    protected $itemValidator;

    /**
     * Contructor
     * 
     * @param array $options
     * @return void
     * @throws \Zend_Validate_Exception
     */
    public function __construct($options)
    {
        if (is_array($options) && array_key_exists('item_validator', $options)) {
            $this->setItemValidator($options['item_validator']);
        } else {
            throw new \Zend_Validate_Exception(__('Item validator is required'));
        }
    }
    
    /**
     * Get item validator
     * 
     * @return \Zend_Validate_Abstract
     */
    public function getItemValidator()
    {
        return $this->itemValidator;
    }
    
    /**
     * Set item validator
     *
     * @param \Zend_Validate_Abstract $itemValidator
     * @return $this
     */
    public function setItemValidator($itemValidator)
    {
        $this->itemValidator = $itemValidator;
        return $this;
    }
    
    /**
     * Check if value is valid
     * 
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        if (!is_array($value)) {
            $this->_error(self::INVALID);
            return false;
        }
        $this->_setValue($value);
        foreach ($value as $item) {
            if (!$this->itemValidator->isValid($item)) {
                $this->_error(self::INVALID_ITEM);
                return false;
            }
        }
        return true;
    }
    
}