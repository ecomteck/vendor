<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * Code validator
 */
class CodeValidator extends \Ecombricks\Framework\Validator\StringValidator
{
    
    /**
     * Is number first character allowed
     * 
     * @var bool
     */
    protected $isNumberFirstCharacterAllowed = false;
    
    /**
     * Constructor
     * 
     * @param array $options
     * @return void
     */
    public function __construct($options = [])
    {
        parent::__construct($options);
        if (isset($options['number_first_character_allowed'])) {
            $this->setIsNumberFirstCharacterAllowed(($options['number_first_character_allowed']) ? true : false);
        }
    }
    
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
            ->setMaxLength(32)
            ->setLabel('code');
        return $this;
    }
    
    /**
     * Get is number first character allowed
     * 
     * @return bool
     */
    public function getIsNumberFirstCharacterAllowed()
    {
        return $this->isNumberFirstCharacterAllowed;
    }
    
    /**
     * Set is number first character allowed
     * 
     * @param bool $isNumberFirstCharacterAllowed
     * @return $this
     */
    public function setIsNumberFirstCharacterAllowed($isNumberFirstCharacterAllowed)
    {
        $this->isNumberFirstCharacterAllowed = $isNumberFirstCharacterAllowed;
        return $this;
    }
    
    /**
     * Check if is number first character allowed
     * 
     * @return bool
     */
    public function isNumberFirstCharacterAllowed()
    {
        return $this->getIsNumberFirstCharacterAllowed();
    }
    
    /**
     * Callback validator function
     * 
     * @param string $value
     * @return bool
     */
    public function callbackValidatorFunction($value)
    {
        return $this->checkUniqueness($value, 'getIdByCode');
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
        $this->addRegexValidator($value);
        if ($this->hasRegexValidator()) {
            $this->getRegexValidator()
                ->setPattern(
                    ($this->isNumberFirstCharacterAllowed()) ? 
                        '/^[a-z0-9]+[a-z0-9_]*$/' : 
                        '/^[a-z]+[a-z0-9_]*$/'
                )
                ->setMessage(
                    ($this->isNumberFirstCharacterAllowed()) ? 
                        __(
                            '%1 may only contain letters (a-z), numbers (0-9) or underscore(_), the first character must be a letter or a number', 
                            $this->getLabelFirstLetterUppercased()
                        ) :
                        __(
                            '%1 may only contain letters (a-z), numbers (0-9) or underscore(_), the first character must be a letter', 
                            $this->getLabelFirstLetterUppercased()
                        ),
                    \Zend_Validate_Regex::NOT_MATCH
                );
        }
        $this->addCallbackValidator($value);
        if ($this->hasCallbackValidator()) {
            $this->getCallbackValidator()
                ->setMessage(
                    __('%1 with the same code is already exists.', $this->getObjectLabelFirstLetterUppercased()),
                    \Zend_Validate_Callback::INVALID_VALUE
                );
        }
        return $this;
    }
    
}