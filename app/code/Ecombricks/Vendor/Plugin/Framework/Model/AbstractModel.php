<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Plugin\Framework\Model;

/**
 * Abstract model plugin
 */
class AbstractModel
{
    
    /**
     * Set data
     * 
     * @param \Magento\Framework\Model\AbstractModel $object
     * @param \Closure $proceed
     * @param string|array $key
     * @param mixed $value
     * @return \Magento\Framework\Model\AbstractModel
     */
    protected function setData(
        \Magento\Framework\Model\AbstractModel $object,
        \Closure $proceed,
        $key,
        $value = null
    )
    {
        $proceed($key, $value);
        if (($key === (array) $key) && (isset($key['vendor_id']) || array_key_exists('vendor_id', $key))) {
            $object->setVendorId($key['vendor_id']);
        } else if (($key !== (array) $key) && ($key == 'vendor_id')) {
            $object->setVendorId($value);
        }
        return $object;
    }
    
    /**
     * Unset data
     * 
     * @param \Magento\Framework\Model\AbstractModel $object
     * @param \Closure $proceed
     * @param null|string|array $key
     * @return \Magento\Framework\Model\AbstractModel
     */
    protected function unsetData(
        \Magento\Framework\Model\AbstractModel $object,
        \Closure $proceed,
        $key = null
    )
    {
        if (
            ($key === (array) $key) && (isset($key['vendor_id']) || array_key_exists('vendor_id', $key)) || 
            ($key !== (array) $key) && ($key == 'vendor_id')
        ) {
            $object->unsVendorId();
        }
        $proceed($key);
        return $object;
    }
    
}