<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * Time validator
 */
class TimeValidator extends \Ecombricks\Framework\Validator\DateTimeValidator
{
    
    /**
     * Initialize
     * 
     * @return $this
     */
    public function _construct()
    {
        parent::_construct();
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
        if ($this->hasDateTimeValidator()) {
            $label = $this->getLabelFirstLetterUppercased();
            $this->getDateTimeValidator()
                ->setMessages([
                    \Ecombricks\Framework\Validator\Plain\DateTimeValidator::INVALID => __('%1 does not appear to be a valid time.', $label)
                ]);
        }
        return $this;
    }
    
}