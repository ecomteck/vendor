<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator\Plain;

/**
 * Greater or equal plain validator
 */
class GreaterOrEqualValidator extends \Zend_Validate_GreaterThan
{
    
    /**
     * Check if value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        $this->_setValue($value);
        if ($this->_min > $value) {
            $this->_error(self::NOT_GREATER);
            return false;
        }
        return true;
    }
    
}