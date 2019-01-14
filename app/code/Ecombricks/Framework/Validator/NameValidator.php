<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * Name validator
 */
class NameValidator extends \Ecombricks\Framework\Validator\StringValidator
{
    
    /**
     * Initialize
     * 
     * @return $this
     */
    public function _construct()
    {
        parent::_construct();
        $this
            ->setMinLength(2)
            ->setMaxLength(64)
            ->setLabel('name');
        return $this;
    }
    
    /**
     * Callback validator function
     * 
     * @param string $value
     * @return bool
     */
    public function callbackValidatorFunction($value)
    {
        return $this->checkUniqueness($value, 'getIdByName');
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
        $this->addCallbackValidator($value);
        if ($this->hasCallbackValidator()) {
            $this->getCallbackValidator()
                ->setMessage(
                    __('%1 with the same name is already exists.', $this->getObjectLabelFirstLetterUppercased()),
                    \Zend_Validate_Callback::INVALID_VALUE
                );
        }
        return $this;
    }
    
}