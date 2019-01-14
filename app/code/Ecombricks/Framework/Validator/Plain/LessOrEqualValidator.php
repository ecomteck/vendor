<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator\Plain;

/**
 * Less or equal plain validator
 */
class LessOrEqualValidator extends \Zend_Validate_LessThan
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
        if ($this->_max < $value) {
            $this->_error(self::NOT_LESS);
            return false;
        }
        return true;
    }
    
}