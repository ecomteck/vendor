<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Model\Backend\Session\Quote;

/**
 * Backend quote session model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Underscore cache
     *
     * @var array
     */
    protected static $vendorUnderscoreCache = [];
    
    /**
     * After set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function afterSetVendorId($vendorId)
    {
        $this->storage->setData('vendor_id', $vendorId);
        return $this;
    }
    
    /**
     * Get vendor ID
     * 
     * @return int
     */
    public function getVendorId()
    {
        return $this->storage->getData('vendor_id');
    }
    
    /**
     * Unset vendor ID
     * 
     * @return $this
     */
    public function unsVendorId()
    {
        $this->storage->unsetData('vendor_id');
        return $this;
    }
    
    /**
     * Underscore
     * 
     * @param string $name
     * @return string
     */
    public function vendorUnderscore($name)
    {
        if (isset(self::$vendorUnderscoreCache[$name])) {
            return self::$vendorUnderscoreCache[$name];
        }
        $result = strtolower(trim(preg_replace('/([A-Z]|[0-9]+)/', "_$1", $name), '_'));
        self::$vendorUnderscoreCache[$name] = $result;
        return $result;
    }
    
    /**
     * Call
     * 
     * @param string $method
     * @param array $args
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function vendorCall($method, $args)
    {
        $methodPrefix = substr($method, 0, 3);
        $validMethodPrefixes = ['get', 'set', 'uns', 'has'];
        if (!in_array($methodPrefix, $validMethodPrefixes)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid method %s::%s(%s)', get_class($this), $method, print_r($args, 1))
            );
        }
        $vendorId = $this->getVendorId();
        $key = $this->vendorUnderscore(substr($method, 3));
        if (!in_array($key, [ 'customer_id', 'store_id', 'currency_id', 'vendor_id' ]) && $vendorId) {
            $vendorMethod = $method.'Vendor'.$vendorId;
        } else {
            $vendorMethod = $method;
        }
        $return = call_user_func_array([ $this->storage, $vendorMethod ], $args);
        return $return === $this->storage ? $this : $return;
    }
    
}