<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * Ip validator
 */
class IpValidator extends \Ecombricks\Framework\Validator\StringValidator
{
    
    /**
     * IP validator
     * 
     * @var \Zend_Validate_Ip
     */
    protected $ipValidator;
    
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
     * Initialize
     * 
     * @return $this
     */
    public function _construct()
    {
        parent::_construct();
        $this
            ->setMinLength(7)
            ->setMaxLength(64)
            ->setLabel('ip');
        return $this;
    }
    
    /**
     * Check if IP validator is set
     * 
     * @return bool
     */
    public function hasIpValidator()
    {
        return $this->ipValidator !== null;
    }
    
    /**
     * Get IP validator
     * 
     * @return \Zend_Validate_Ip
     */
    public function getIpValidator()
    {
        if ($this->ipValidator === null) {
            $validator = new \Zend_Validate_Ip([]);
            $validator->setMessages([
                \Zend_Validate_Ip::INVALID => __('%1 invalid type given.', $this->getLabelFirstLetterUppercased()),
                \Zend_Validate_Ip::NOT_IP_ADDRESS => __('%1 does not appear to be a valid IP address.', $this->getLabelFirstLetterUppercased())
            ]);
            $this->ipValidator = $validator;
        }
        return $this->ipValidator;
    }
    
    /**
     * Add IP validator
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addIpValidator($value)
    {
        if ($value === null) {
            return $this;
        }
        $this->addValidator($this->getIpValidator(), true);
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
        $this->addIpValidator($value);
        return $this;
    }
    
}
