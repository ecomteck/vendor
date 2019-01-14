<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * Text validator
 */
class TextValidator extends \Ecombricks\Framework\Validator\StringValidator
{
    
    /**
     * Types
     */
    const TYPE_TINYTEXT = 'tinytext';
    const TYPE_TEXT = 'text';
    const TYPE_MEDIUMTEXT = 'mediumtext';
    const TYPE_LONGTEXT = 'longtext';
    
    /**
     * Type
     * 
     * @var string
     */
    protected $type = self::TYPE_TEXT;
    
    /**
     * Constructor
     * 
     * @param array $options
     * @return void
     */
    public function __construct($options = [])
    {
        parent::__construct($options);
        if (!empty($options['type'])) {
            $this->setType($options['type']);
        }
    }
    
    /**
     * Get type
     * 
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Set type
     * 
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    /**
     * Get max length
     * 
     * @return int
     */
    public function getMaxLength()
    {
        switch ($this->getType()) {
            case self::TYPE_TINYTEXT : 
                $value = 255;
                break;
            case self::TYPE_TEXT : 
                $value = 65535;
                break;
            case self::TYPE_MEDIUMTEXT : 
                $value = 16777215;
                break;
            case self::TYPE_LONGTEXT : 
                $value = 4294967295;
                break;
            default: 
                $value = 65535;
                break;
        }
        return $value;
    }
    
}