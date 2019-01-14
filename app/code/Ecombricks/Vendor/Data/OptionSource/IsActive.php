<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Data\OptionSource;

/**
 * Is active option source
 */
class IsActive implements \Magento\Framework\Data\OptionSourceInterface 
{
    
    /**
     * Get options
     * 
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['label' => 'Enabled', 'value' => 1],
            ['label' => 'Disabled', 'value' => 0]
        ];
    }
    
}