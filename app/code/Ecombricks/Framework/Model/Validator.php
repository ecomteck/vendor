<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Model;

/**
 * Model validator
 */
class Validator extends \Magento\Framework\Validator\AbstractValidator
{
    
    /**
     * Validators
     * 
     * @var \Zend_Validate_Interface[]
     */
    protected $validators;
    
    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        $this->validators = [];
        $this->_construct();
    }
    
    /**
     * Construct
     * 
     * @return $this
     */
    public function _construct()
    {
        return $this;
    }
    
    /**
     * Add message
     *
     * @param string $message
     * @return $this
     */
    protected function addMessage($message)
    {
        $this->_messages[] = $message;
        return $this;
    }
    
    /**
     * Clear validators
     * 
     * @return $this
     */
    protected function clearValidators()
    {
        $this->validators = [];
        return $this;
    }
    
    /**
     * Check if has validators
     * 
     * @return bool
     */
    public function hasValidators()
    {
        return !empty($this->validators);
    }
    
    /**
     * Get validators
     * 
     * @return \Zend_Validate_Interface[]
     */
    public function getValidators()
    {
        return $this->validators;
    }
    
    /**
     * Add validator
     * 
     * @param string $key
     * @param \Zend_Validate_Interface $validator
     * @return $this
     */
    public function addValidator($key, $validator)
    {
        $this->validators[$key] = $validator;
        return $this;
    }
    
    /**
     * Add validators
     * 
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function addValidators($object)
    {
        $this->_clearMessages();
        $this->clearValidators();
        return $this;
    }
    
    /**
     * Check if object is valid
     * 
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return bool
     */
    public function isValid($object)
    {
        $isValid = true;
        $this->addValidators($object);
        if (!$this->hasValidators()) {
            return $isValid;
        }
        foreach ($this->getValidators() as $key => $validator) {
            if ($validator->isValid($object->getDataUsingMethod($key))) {
                continue;
            }
            $messages = $validator->getMessages();
            if (empty($messages)) {
                continue;
            }
            foreach ($messages as $message) {
                $this->addMessage($message);
            }
            $isValid = false;
        }
        return $isValid;
    }
    
}