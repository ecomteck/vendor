<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * Boolean validator
 */
class BooleanValidator extends \Ecombricks\Framework\Validator\IntegerValidator
{
    
    /**
     * Initialize
     * 
     * @return $this
     */
    public function _construct()
    {
        parent::_construct();
        $this->setType(self::TYPE_TINYINT);
        $this->setUnsigned(true);
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
            $this
                ->getInArrayValidator()
                ->setMessage(
                    __('%1 is invalid.', $this->getLabelFirstLetterUppercased()),
                    \Zend_Validate_InArray::NOT_IN_ARRAY
                )
                ->setHaystack([0, 1]);
        }
        return $this;
    }
    
}