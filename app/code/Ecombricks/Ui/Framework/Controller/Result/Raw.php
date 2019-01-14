<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Ui\Framework\Controller\Result;

/**
 * Raw controller result
 */
class Raw extends \Magento\Framework\Controller\Result\Raw
{
    
    /**
     * Get contents
     * 
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }
    
}