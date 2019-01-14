<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * Date time validator
 */
class DateTimeValidator extends \Ecombricks\Framework\Validator\Validator
{
    
    /**
     * Date time validator
     * 
     * @var \Ecombricks\Framework\Validator\Plain\DateTimeValidator
     */
    protected $dateTimeValidator;
    
    /**
     * Constructor
     * 
     * @param array $options
     * @return void
     */
    public function __construct($options = [])
    {
        parent::__construct($options);
    }
    
    /**
     * Check if date time validator is set
     * 
     * @return bool
     */
    public function hasDateTimeValidator()
    {
        return $this->dateTimeValidator !== null;
    }
    
    /**
     * Get date time validator
     * 
     * @return \Ecombricks\Framework\Validator\Plain\DateTimeValidator
     */
    public function getDateTimeValidator()
    {
        if ($this->dateTimeValidator === null) {
            $validator = new \Ecombricks\Framework\Validator\Plain\DateTimeValidator();
            $label = $this->getLabelFirstLetterUppercased();
            $validator->setMessages([
                \Ecombricks\Framework\Validator\Plain\DateTimeValidator::INVALID => __('%1 does not appear to be a valid datetime.', $label)
            ]);
            $this->dateTimeValidator = $validator;
        }
        return $this->dateTimeValidator;
    }
    
    /**
     * Add date time validator
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addDateTimeValidator($value)
    {
        if ($value === null) {
            return $this;
        }
        $this->addValidator($this->getDateTimeValidator(), true);
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
        $this->addDateTimeValidator($value);
        return $this;
    }
    
}