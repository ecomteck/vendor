<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Session;

/**
 * Generic session manager
 */
class Generic extends \Magento\Framework\Session\Generic
{
    
    /**
     * Vendor ID
     * 
     * @var int
     */
    protected $vendorId;
    
    /**
     * Vendor keys
     * 
     * @var array
     */
    protected $vendorKeys;
    
    /**
     * Underscore cache
     *
     * @var array
     */
    protected static $vendorUnderscoreCache = [];
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\App\Request\Http $request
     * @param \Magento\Framework\Session\SidResolverInterface $sidResolver
     * @param \Magento\Framework\Session\Config\ConfigInterface $sessionConfig
     * @param \Magento\Framework\Session\SaveHandlerInterface $saveHandler
     * @param \Magento\Framework\Session\ValidatorInterface $validator
     * @param \Magento\Framework\Session\StorageInterface $storage
     * @param \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager
     * @param \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory
     * @param \Magento\Framework\App\State $appState
     * @param array $vendorKeys
     * @throws \Magento\Framework\Exception\SessionException
     * @return void
     */
    public function __construct(
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Session\SidResolverInterface $sidResolver,
        \Magento\Framework\Session\Config\ConfigInterface $sessionConfig,
        \Magento\Framework\Session\SaveHandlerInterface $saveHandler,
        \Magento\Framework\Session\ValidatorInterface $validator,
        \Magento\Framework\Session\StorageInterface $storage,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
        \Magento\Framework\App\State $appState,
        $vendorKeys = []
    )
    {
        $this->vendorKeys = $vendorKeys;
        parent::__construct(
            $request, 
            $sidResolver, 
            $sessionConfig, 
            $saveHandler, 
            $validator, 
            $storage, 
            $cookieManager, 
            $cookieMetadataFactory, 
            $appState
        );
    }
    
    /**
     * Underscore
     * 
     * @param string $name
     * @return string
     */
    protected function vendorUnderscore($name)
    {
        if (isset(self::$vendorUnderscoreCache[$name])) {
            return self::$vendorUnderscoreCache[$name];
        }
        $result = strtolower(trim(preg_replace('/([A-Z]|[0-9]+)/', "_$1", $name), '_'));
        self::$vendorUnderscoreCache[$name] = $result;
        return $result;
    }
    
    /**
     * Set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
        return $this;
    }
    
    /**
     * Get vendor ID
     * 
     * @return int
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }
    
    /**
     * Unset vendor ID
     * 
     * @return $this
     */
    public function unsVendorId()
    {
        $this->vendorId = null;
        return $this;
    }
    
    /**
     * Get key by method
     * 
     * @param string $method
     * @return string
     */
    protected function getKeyByMethod($method)
    {
        return (strlen($method) > 3) ? $this->vendorUnderscore(substr($method, 3)) : null;
    }
    
    /**
     * Validate method
     * 
     * @param string $method
     * @param array $args
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function validateMethod($method, $args)
    {
        $methodPrefix = substr($method, 0, 3);
        $validMethodPrefixes = ['get', 'set', 'uns', 'has'];
        if (!in_array($methodPrefix, $validMethodPrefixes)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid method %s::%s(%s)', get_class($this), $method, print_r($args, 1))
            );
        }
        return $this;
    }
    
    /**
     * Call
     *
     * @param string $method
     * @param array $args
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function __call($method, $args)
    {
        $vendorId = $this->getVendorId();
        if (!$vendorId) {
            return parent::__call($method, $args);
        }
        $key = $this->getKeyByMethod($method);
        if (!$key || !in_array($key, $this->vendorKeys)) {
            return parent::__call($method, $args);
        }
        $this->validateMethod($method, $args);
        $return = call_user_func_array([ $this->storage, $method.'Vendor'.$vendorId ], $args);
        return $return === $this->storage ? $this : $return;
    }
    
    /**
     * Get data
     *
     * @param string $key
     * @param bool $clear
     * @return mixed
     */
    public function getData($key = '', $clear = false)
    {
        $vendorId = $this->getVendorId();
        if (!$vendorId) {
            return parent::getData($key, $clear);
        }
        if (!$key || !in_array($key, $this->vendorKeys)) {
            return parent::getData($key, $clear);
        }
        $vendorKey = $key.'_vendor'.$vendorId;
        $data = $this->storage->getData($vendorKey);
        if ($clear && isset($data)) {
            $this->storage->unsetData($vendorKey);
        }
        return $data;
    }
    
}