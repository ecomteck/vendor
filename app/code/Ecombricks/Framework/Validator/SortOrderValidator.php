<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Validator;

/**
 * Sort order validator
 */
class SortOrderValidator extends \Ecombricks\Framework\Validator\IntegerValidator
{
    
    /**
     * Initialize
     * 
     * @return $this
     */
    public function _construct()
    {
        parent::_construct();
        $this->setType(self::TYPE_SMALLINT);
        $this->setUnsigned(true);
        $this->setLabel(__('sort order'));
        return $this;
    }
    
}