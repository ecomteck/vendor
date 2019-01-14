<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Model;

/**
 * Abstract model
 */
class AbstractModel extends \Magento\Framework\Model\AbstractModel
{
    
    /**
     * Default data
     * 
     * @var array
     */
    protected $defaultData = [];
    
    /**
     * Messages
     * 
     * @var array
     */
    protected $messages = [];
    
    /**
     * Filter manager
     *
     * @var \Magento\Framework\Filter\FilterManager
     */
    protected $filterManager;
    
    /**
     * Validator
     * 
     * @var \Magento\Framework\Validator\ValidatorInterface
     */
    protected $validator;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Filter\FilterManager $filterManager
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Filter\FilterManager $filterManager,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    )
    {
        $this->filterManager = $filterManager;
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
    }
    
    /**
     * Initialize
     * 
     * @return void
     */
    protected function _construct()
    {
        $this->fromArray($this->getDefaultData());
        parent::_construct();
    }
    
    /**
     * Get default data
     *
     * @param string|null $key
     * @return mixed
     */
    public function getDefaultData($key = null)
    {
        if ($key === null) {
            return $this->defaultData;
        }
        if (isset($this->defaultData[$key])) {
            return $this->defaultData[$key];
        }
        return null;
    }
    
    /**
     * Set default data
     * 
     * @param string|array $key
     * @param mixed|null $value
     * @return $this
     */
    public function setDefaultData($key = null, $value = null)
    {
        if ($key === ((array) $key)) {
            $this->defaultData = $key;
        } else {
            $this->defaultData[$key] = $value;
        }
        return $this;
    }
    
    /**
     * Get value copy
     * 
     * @param string $value
     * @param string $separatorPattern
     * @param string $separator
     * @return string
     */
    protected function getValueCopy($value, $separatorPattern = '\s', $separator = ' ')
    {
        $matches = [];
        return preg_match('/(.*)'.$separatorPattern.'(\d+)$/', $value, $matches) ? 
            $matches[1].$separator.($matches[2] + 1) : 
            $value.$separator.'2';
    }
    
    /**
     * Get unique data copy
     * 
     * @param string $key
     * @param string $separatorPattern
     * @param string $separator
     * @return string
     */
    protected function getUniqueDataCopy($key, $separatorPattern = '\s', $separator = ' ')
    {
        $value = $this->getDataUsingMethod($key);
        if (($value === null) || !is_string($value)) {
            return null;
        }
        $resource = $this->getResource();
        $isUniqueValueCopy = false;
        do {
            $value = $this->getValueCopy($value, $separatorPattern, $separator);
            if (!$resource->getIdByField($key, $value)) {
                $isUniqueValueCopy = true;
            }
        } while (!$isUniqueValueCopy);
        return $value;
    }
    
    /**
     * Clear messages
     *
     * @return $this
     */
    protected function clearMessages()
    {
        $this->messages = [];
        return $this;
    }
    
    /**
     * Check if has messages
     *
     * @return bool
     */
    public function hasMessages()
    {
        return !empty($this->messages);
    }
    
    /**
     * Get messages
     * 
     * @return string[]
     */
    public function getMessages()
    {
        return $this->messages;
    }
    
    /**
     * Add message
     * 
     * @param string $message
     * @return $this
     */
    public function addMessage($message)
    {
        $this->messages[] = $message;
        return $this;
    }
    
    /**
     * To array
     *
     * @param array $keys
     * @return array
     */
    public function toArray(array $keys = [])
    {
        $array = [];
        if (empty($keys)) {
            $keys = array_keys($this->_data);
        }
        foreach ($keys as $key) {
            $array[$key] = $this->getDataUsingMethod($key);
        }
        if ($this->hasMessages()) {
            $array['messages'] = [];
            foreach ($this->getMessages() as $message) {
                $array['messages'][] = (string) $message;
            }
        }
        return $array;
    }
    
    /**
     * Get copy array
     * 
     * @return array
     */
    public function getCopyArray()
    {
        $array = $this->toArray();
        if (isset($array[$this->_idFieldName])) {
            unset($array[$this->_idFieldName]);
        }
        if (isset($array[$this->staticIdFieldName])) {
            unset($array[$this->staticIdFieldName]);
        }
        if (isset($array['messages'])) {
            unset($array['messages']);
        }
        return $array;
    }
    
    /**
     * From array
     *
     * @param array $array
     * @param array $keys
     * @return $this
     */
    public function fromArray($array, array $keys = [])
    {
        $isEmptyKeys = empty($keys);
        foreach ($array as $key => $value) {
            if ($isEmptyKeys || in_array($key, $keys)) {
                $this->setDataUsingMethod($key, $value);
            }
        }
        if (
            !empty($array['messages']) && 
            is_array($array['messages']) && 
            ($isEmptyKeys || in_array('messages', $keys))
        ) {
            $this->clearMessages();
            foreach ($array['messages'] as $message) {
                $this->addMessage($message);
            }
        }
        return $this;
    }
    
    /**
     * Filter decimal
     * 
     * @param mixed $value
     * @param int $precision
     * @return mixed
     */
    protected function filterDecimal($value, $precision = 4)
    {
        if ($value === null) {
            return $value;
        }
        return (
            is_float($value) || 
            (is_string($value) && $value === (string) (float) $value)
        ) ? round($value, $precision) : $value;
    }
    
    /**
     * Filter string
     * 
     * @param mixed $value
     * @return mixed
     */
    protected function filterString($value)
    {
        if ($value === null) {
            return $value;
        }
        return (is_string($value)) ? $this->filterManager->stripTags($value) : $value;
    }
    
    /**
     * Filter
     * 
     * @return $this
     */
    protected function filter()
    {
        return $this;
    }
    
    /**
     * Get validator exception messages
     * 
     * @param \Magento\Framework\Validator\Exception $validatorException
     * @return array
     */
    protected function getValidatorExceptionMessages($validatorException)
    {
        $messages = [];
        foreach ($validatorException->getMessages() as $message) {
            $messages[] = $message->getText();
        }
        return $messages;
    }
    
    /**
     * Throw validator exception
     * 
     * @param array $messages
     * @return void
     * @throws \Magento\Framework\Validator\Exception
     */
    protected function throwValidatorException($messages)
    {
        $exception = new \Magento\Framework\Validator\Exception(
            new \Magento\Framework\Phrase(implode(PHP_EOL, $messages))
        );
        foreach ($messages as $message) {
            $exception->addMessage(new \Magento\Framework\Message\Error($message));
            $this->addMessage($message);
        }
        throw $exception;
    }
    
    /**
     * Validate before save
     *
     * @return $this
     * @throws \Magento\Framework\Validator\Exception
     */
    public function validateBeforeSave()
    {
        $this->filter();
        $this->clearMessages();
        $validator = $this->_getValidatorBeforeSave();
        if ($validator && !$validator->isValid($this)) {
            $this->throwValidatorException($validator->getMessages());
        }
        return $this;
    }
    
    /**
     * Get validation rules before save
     *
     * @return \Magento\Framework\Validator\ValidatorInterface|null
     */
    protected function _getValidationRulesBeforeSave()
    {
        return $this->validator;
    }
    
}