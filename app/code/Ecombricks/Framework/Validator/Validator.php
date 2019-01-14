<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * Validator
 */
class Validator extends \Zend_Validate
{
    
    /**
     * Object
     * 
     * @var \Magento\Framework\Model\AbstractModel
     */
    protected $object;
    
    /**
     * Label
     * 
     * @var string
     */
    protected $label = 'value';
    
    /**
     * Object label
     * 
     * @var string
     */
    protected $objectLabel = 'object';
    
    /**
     * Is required
     * 
     * @var bool
     */
    protected $isRequired = false;
    
    /**
     * Not empty validator
     * 
     * @var \Zend_Validate_NotEmpty
     */
    protected $notEmptyValidator;
    
    /**
     * Less validator
     * 
     * @var \Zend_Validate_LessThan
     */
    protected $lessValidator;
    
    /**
     * Less or equal validator
     * 
     * @var \Zend_Validate_LessThan
     */
    protected $lessOrEqualValidator;
    
    /**
     * Greater validator
     * 
     * @var \Zend_Validate_GreaterThan
     */
    protected $greaterValidator;
    
    /**
     * Greater or equal validator
     * 
     * @var \Zend_Validate_GreaterThan
     */
    protected $greaterOrEqualValidator;
    
    /**
     * In array validator
     * 
     * @var \Zend_Validate_InArray
     */
    protected $inArrayValidator;
    
    /**
     * Array validator
     * 
     * @var \Ecombricks\Framework\Validator\Plain\ArrayValidator
     */
    protected $arrayValidator;
    
    /**
     * Callback validator
     * 
     * @var \Zend_Validate_Callback
     */
    protected $callbackValidator;
    
    /**
     * Constructor
     * 
     * @param array $options
     * @return void
     */
    public function __construct($options = [])
    {
        $this->_construct();
        if (!empty($options['object'])) {
            $this->setObject($options['object']);
        }
        if (!empty($options['label'])) {
            $this->setLabel($options['label']);
        }
        if (!empty($options['object_label'])) {
            $this->setObjectLabel($options['object_label']);
        }
        if (isset($options['required'])) {
            $this->setIsRequired(($options['required']) ? true : false);
        }
    }
    
    /**
     * Initialize
     * 
     * @return $this
     */
    public function _construct()
    {
        return $this;
    }
    
    /**
     * Clear validators
     * 
     * @return $this
     */
    protected function clearValidators()
    {
        $this->_validators = [];
        return $this;
    }
    
    /**
     * Get object
     * 
     * @return \Magento\Framework\Model\AbstractModel
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getObject()
    {
        if (empty($this->object) || !($this->object instanceof \Magento\Framework\Model\AbstractModel)) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Object is undefined for the validator.'));
        }
        return $this->object;
    }
    
    /**
     * Set object
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function setObject($object)
    {
        if (!($object instanceof \Magento\Framework\Model\AbstractModel)) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Invalid object is passed to the validator.'));
        }
        $this->object = $object;
        return $this;
    }
    
    /**
     * Get label
     * 
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
    
    /**
     * Get label first letter uppercased
     * 
     * @return string
     */
    public function getLabelFirstLetterUppercased()
    {
        return ucfirst($this->getLabel());
    }
    
    /**
     * Set label
     * 
     * @param string $label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }
    
    /**
     * Get object label
     * 
     * @return string
     */
    public function getObjectLabel()
    {
        return $this->objectLabel;
    }
    
    /**
     * Get object label first letter uppercased
     * 
     * @return string
     */
    public function getObjectLabelFirstLetterUppercased()
    {
        return ucfirst($this->getObjectLabel());
    }
    
    /**
     * Set object label
     * 
     * @param string $objectLabel
     * @return $this
     */
    public function setObjectLabel($objectLabel)
    {
        $this->objectLabel = $objectLabel;
        return $this;
    }
    
    /**
     * Get is required
     * 
     * @return bool
     */
    public function getIsRequired()
    {
        return $this->isRequired;
    }
    
    /**
     * Check if is required
     * 
     * @return bool
     */
    public function isRequired()
    {
        return $this->getIsRequired();
    }
    
    /**
     * Set is required
     * 
     * @param bool $isRequired
     * @return $this
     */
    public function setIsRequired($isRequired)
    {
        $this->isRequired = $isRequired;
        return $this;
    }
    
    /**
     * Check if not empty validator is set
     * 
     * @return bool
     */
    public function hasNotEmptyValidator()
    {
        return $this->notEmptyValidator !== null;
    }
    
    /**
     * Get not empty validator
     * 
     * @return \Zend_Validate_NotEmpty
     */
    public function getNotEmptyValidator()
    {
        if ($this->notEmptyValidator === null) {
            $validator = new \Zend_Validate_NotEmpty();
            $validator->setMessages([
                \Zend_Validate_NotEmpty::INVALID => __('%1 invalid type given.', $this->getLabelFirstLetterUppercased()),
                \Zend_Validate_NotEmpty::IS_EMPTY => __('%1 is required.', $this->getLabelFirstLetterUppercased())
            ]);
            $this->notEmptyValidator = $validator;
        }
        return $this->notEmptyValidator;
    }
    
    /**
     * Add not empty validator
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addNotEmptyValidator($value)
    {
        if (!$this->isRequired()) {
            return $this;
        }
        $this->addValidator(
            $this->getNotEmptyValidator()->setType(\Zend_Validate_NotEmpty::ALL),
            true
        );
        return $this;
    }
    
    /**
     * Check if less validator is set
     * 
     * @return bool
     */
    public function hasLessValidator()
    {
        return $this->lessValidator !== null;
    }
    
    /**
     * Get less validator
     * 
     * @return \Zend_Validate_LessThan
     */
    public function getLessValidator()
    {
        if ($this->lessValidator === null) {
            $validator = new \Zend_Validate_LessThan(['max' => 0]);
            $validator->setMessages([
                \Zend_Validate_LessThan::NOT_LESS => __('%1 must be less than %max%.', $this->getLabelFirstLetterUppercased()),
            ]);
            $this->lessValidator = $validator;
        }
        return $this->lessValidator;
    }
    
    /**
     * Add less validator
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addLessValidator($value)
    {
        if ($value === null) {
            return $this;
        }
        $this->addValidator($this->getLessValidator(), true);
        return $this;
    }
    
    /**
     * Check if less or equal validator is set
     * 
     * @return bool
     */
    public function hasLessOrEqualValidator()
    {
        return $this->lessOrEqualValidator !== null;
    }
    
    /**
     * Get less or equal validator
     * 
     * @return \Ecombricks\Framework\Validator\Plain\LessOrEqualValidator
     */
    public function getLessOrEqualValidator()
    {
        if ($this->lessOrEqualValidator === null) {
            $validator = new \Ecombricks\Framework\Validator\Plain\LessOrEqualValidator(['max' => 0]);
            $validator->setMessages([
                \Zend_Validate_LessThan::NOT_LESS => __('%1 must be less than or equal to %max%.', $this->getLabelFirstLetterUppercased()),
            ]);
            $this->lessOrEqualValidator = $validator;
        }
        return $this->lessOrEqualValidator;
    }
    
    /**
     * Add less or equal validator
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addLessOrEqualValidator($value)
    {
        if ($value === null) {
            return $this;
        }
        $this->addValidator($this->getLessOrEqualValidator(), true);
        return $this;
    }
    
    /**
     * Check if greater validator is set
     * 
     * @return bool
     */
    public function hasGreaterValidator()
    {
        return $this->greaterValidator !== null;
    }
    
    /**
     * Get greater validator
     * 
     * @return \Zend_Validate_GreaterThan
     */
    public function getGreaterValidator()
    {
        if ($this->greaterValidator === null) {
            $validator = new \Zend_Validate_GreaterThan(['min' => 0]);
            $validator->setMessages([
                \Zend_Validate_GreaterThan::NOT_GREATER => __('%1 must be greater than %min%.', $this->getLabelFirstLetterUppercased()),
            ]);
            $this->greaterValidator = $validator;
        }
        return $this->greaterValidator;
    }
    
    /**
     * Add greater validator
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addGreaterValidator($value)
    {
        if ($value === null) {
            return $this;
        }
        $this->addValidator($this->getGreaterValidator(), true);
        return $this;
    }
    
    /**
     * Check if greater or equal validator is set
     * 
     * @return bool
     */
    public function hasGreaterOrEqualValidator()
    {
        return $this->greaterOrEqualValidator !== null;
    }
    
    /**
     * Get greater or equal validator
     * 
     * @return \Ecombricks\Framework\Validator\Plain\GreaterOrEqualValidator
     */
    public function getGreaterOrEqualValidator()
    {
        if ($this->greaterOrEqualValidator === null) {
            $validator = new \Ecombricks\Framework\Validator\Plain\GreaterOrEqualValidator(['min' => 0]);
            $validator->setMessages([
                \Zend_Validate_GreaterThan::NOT_GREATER => __('%1 must be greater than or equal to %min%.', $this->getLabelFirstLetterUppercased()),
            ]);
            $this->greaterOrEqualValidator = $validator;
        }
        return $this->greaterOrEqualValidator;
    }
    
    /**
     * Add greater or equal validator
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addGreaterOrEqualValidator($value)
    {
        if ($value === null) {
            return $this;
        }
        $this->addValidator($this->getGreaterOrEqualValidator(), true);
        return $this;
    }
    
    /**
     * Checkif in array validator is set
     * 
     * @return bool
     */
    public function hasInArrayValidator()
    {
        return $this->inArrayValidator !== null;
    }
    
    /**
     * Get in array validator
     * 
     * @return \Zend_Validate_InArray
     */
    public function getInArrayValidator()
    {
        if ($this->inArrayValidator === null) {
            $validator = new \Zend_Validate_InArray([]);
            $validator->setMessages([
                \Zend_Validate_InArray::NOT_IN_ARRAY => __('%1 was not found in the haystack.', $this->getLabelFirstLetterUppercased()),
            ]);
            $this->inArrayValidator = $validator;
        }
        return $this->inArrayValidator;
    }
    
    /**
     * Add in array validator
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addInArrayValidator($value)
    {
        if ($value === null) {
            return $this;
        }
        $this->addValidator($this->getInArrayValidator(), true);
        return $this;
    }
    
    /**
     * Get array item validator
     * 
     * @return bool
     */
    public function getArrayItemValidator()
    {
        return null;
    }
    
    /**
     * Check if array validator is set
     * 
     * @return bool
     */
    public function hasArrayValidator()
    {
        return $this->arrayValidator !== null;
    }
    
    /**
     * Get array validator
     * 
     * @return \Ecombricks\Framework\Validator\Plain\ArrayValidator
     */
    public function getArrayValidator()
    {
        if ($this->arrayValidator === null) {
            $validator = new \Ecombricks\Framework\Validator\Plain\ArrayValidator(
                ['item_validator' => $this->getArrayItemValidator()]
            );
            $validator->setMessages([
                \Ecombricks\Framework\Validator\Plain\ArrayValidator::INVALID_ITEM => __('%1 contains invalid items.', $this->getLabelFirstLetterUppercased()),
            ]);
            $this->arrayValidator = $validator;
        }
        return $this->arrayValidator;
    }
    
    /**
     * Add array validator
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addArrayValidator($value)
    {
        if ($value === null) {
            return $this;
        }
        $this->addValidator($this->getArrayValidator(), true);
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
        return true;
    }
    
    /**
     * Check if callback validator is set
     * 
     * @return bool
     */
    public function hasCallbackValidator()
    {
        return $this->callbackValidator !== null;
    }
    
    /**
     * Get callback validator
     * 
     * @return \Zend_Validate_Callback
     */
    public function getCallbackValidator()
    {
        if ($this->callbackValidator === null) {
            $validator = new \Zend_Validate_Callback(['callback' => [$this, 'callbackValidatorFunction']]);
            $validator->setMessages([
                \Zend_Validate_Callback::INVALID_VALUE => __('%1 is invalid.', $this->getLabelFirstLetterUppercased())
            ]);
            $this->callbackValidator = $validator;
        }
        return $this->callbackValidator;
    }
    
    /**
     * Add callback validator
     * 
     * @param string $value
     * @return $this
     */
    protected function addCallbackValidator($value)
    {
        if ($value === null) {
            return $this;
        }
        $this->addValidator($this->getCallbackValidator(), true);
        return $this;
    }
    
    /**
     * Check uniqueness
     * 
     * @param string $value
     * @param string $method
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function checkUniqueness($value, $method)
    {
        $object = $this->getObject();
        $resource = $object->getResource();
        if (!method_exists($resource, $method)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('%1 method isn\'t found for the resource %2', $method, get_class($resource))
            );
        }
        $objectId = $resource->{$method}($value);
        return (empty($objectId) || ($objectId == $object->getId()));
    }
    
    /**
     * Add validators
     * 
     * @param mixed $value
     * @return $this
     */
    protected function addValidators($value)
    {
        $this->clearValidators();
        $this->addNotEmptyValidator($value);
        return $this;
    }
    
    /**
     * Check if is valid
     * 
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        $this->addValidators($value);
        return parent::isValid($value);
    }
    
}
