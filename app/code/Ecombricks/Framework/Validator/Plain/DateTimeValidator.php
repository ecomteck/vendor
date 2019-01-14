<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator\Plain;

/**
 * Date time plain validator
 */
class DateTimeValidator extends \Zend_Validate_Abstract
{
    
    /**
     * Constants
     */
    const INVALID = 'invalid';
    
    /**
     * @var array
     */
    protected $_messageTemplates = [
        self::INVALID => "'%value%' is not valid"
    ];
    
    /**
     * Check if value is valid
     * 
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        $this->_setValue($value);
        try {
            $dateTime = new \DateTime($value);
        } catch (\Exception $e) {
            $dateTime = null;
        }
        if (!$dateTime) {
            $this->_error(self::INVALID);
            return false;
        }
        return true;
    }
    
}