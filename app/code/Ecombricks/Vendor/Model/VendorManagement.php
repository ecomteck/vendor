<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Model;

/**
 * Vendor management
 */
class VendorManagement
{
    
    /**
     * Application state
     * 
     * @var \Magento\Framework\App\State
     */
    protected $appState;
    
    /**
     * Authentication
     * 
     * @var \Magento\Backend\Model\Auth
     */
    protected $auth;
    
    /**
     * Vendor collection factory
     * 
     * @var \Ecombricks\Vendor\Model\ResourceModel\Vendor\CollectionFactory
     */
    protected $vendorCollectionFactory;
    
    /**
     * Vendor factory
     * 
     * @var \Ecombricks\Vendor\Model\VendorFactory
     */
    protected $vendorFactory;
    
    /**
     * Vendors
     * 
     * @var \Ecombricks\Vendor\Model\Vendor[]
     */
    protected $vendors;
    
    /**
     * Vendors by code
     * 
     * @var \Ecombricks\Vendor\Model\Vendor[]
     */
    protected $vendorsByCode;
    
    /**
     * Available vendors
     * 
     * @var \Ecombricks\Vendor\Model\Vendor[]
     */
    protected $availableVendors;
    
    /**
     * Vendor IDs
     * 
     * @var array
     */
    protected $vendorIds;
    
    /**
     * Available vendor IDs
     * 
     * @var array
     */
    protected $availableVendorIds;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\App\State\Proxy $appState
     * @param \Magento\Backend\Model\Auth\Proxy $auth
     * @param \Ecombricks\Vendor\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory
     * @param \Ecombricks\Vendor\Model\VendorFactory $vendorFactory
     * @return void
     */
    public function __construct(
        \Magento\Framework\App\State\Proxy $appState,
        \Magento\Backend\Model\Auth\Proxy $auth,
        \Ecombricks\Vendor\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory,
        \Ecombricks\Vendor\Model\VendorFactory $vendorFactory
    )
    {
        $this->appState = $appState;
        $this->auth = $auth;
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        $this->vendorFactory = $vendorFactory;
    }
    
    /**
     * Get area code
     * 
     * @return string
     */
    protected function getAreaCode()
    {
        try {
            $areaCode = $this->appState->getAreaCode();
        } catch (\Exception $exception) {
            unset($exception);
            $areaCode = null;
        }
        return $areaCode;
    }
    
    /**
     * Check if administrator application area is enabled
     * 
     * @return bool
     */
    public function isAdminAppArea()
    {
        return $this->getAreaCode() == \Magento\Framework\App\Area::AREA_ADMINHTML;
    }
    
    /**
     * Check if current user is vendor
     * 
     * @return bool
     */
    public function isCurrentUserVendor()
    {
        return $this->isAdminAppArea() && $this->auth->isLoggedIn() && $this->auth->getUser()->isVendor();
    }
    
    /**
     * Check if vendor is available
     * 
     * @param \Ecombricks\Vendor\Model\Vendor $vendor
     * @return bool
     */
    protected function isVendorAvailable($vendor)
    {
        if ($this->isAdminAppArea()) {
            if (!$this->isCurrentUserVendor()) {
                return true;
            }
            return in_array($vendor->getId(), $this->auth->getUser()->getVendorIds());
        } else {
            return $vendor->isActive();
        }
    }
    
    /**
     * Get vendors
     * 
     * @return \Ecombricks\Vendor\Model\Vendor[]
     */
    public function getVendors()
    {
        if ($this->vendors !== null) {
            return $this->vendors;
        }
        $vendorCollection = $this->vendorCollectionFactory->create();
        $vendorCollection->setDefaultOrder();
        $this->vendors = [];
        foreach ($vendorCollection as $vendor) {
            $vendorId = (int) $vendor->getId();
            $code = strtolower($vendor->getCode());
            $this->vendors[$vendorId] = $vendor;
            $this->vendorsByCode[$code] = $vendor;
        }
        return $this->vendors;
    }
    
    /**
     * Get available vendors
     * 
     * @return \Ecombricks\Vendor\Model\Vendor[]
     */
    public function getAvailableVendors()
    {
        if ($this->availableVendors !== null) {
            return $this->availableVendors;
        }
        $this->availableVendors = [];
        foreach ($this->getVendors() as $vendor) {
            if (!$this->isVendorAvailable($vendor)) {
                continue;
            }
            $vendorId = (int) $vendor->getId();
            $this->availableVendors[$vendorId] = $vendor;
        }
        return $this->availableVendors;
    }
    
    /**
     * Get vendors by IDs
     * 
     * @return \Ecombricks\Vendor\Model\Vendor[]
     */
    public function getVendorsByIds($vendorIds)
    {
        $vendors = [];
        $this->getVendors();
        if (empty($vendorIds)) {
            return $vendors;
        }
        foreach ($vendorIds as $vendorId) {
            if (!empty($this->vendors[$vendorId])) {
                $vendors[$vendorId] = $this->vendors[$vendorId];
            }
        }
        return $vendors;
    }
    
    /**
     * Get vendor IDs
     * 
     * @return array
     */
    public function getVendorIds()
    {
        if ($this->vendorIds !== null) {
            return $this->vendorIds;
        }
        $this->getVendors();
        $this->vendorIds = array_keys($this->vendors);
        return $this->vendorIds;
    }
    
    /**
     * Get available vendor IDs
     * 
     * @return array
     */
    public function getAvailableVendorIds()
    {
        if ($this->availableVendorIds !== null) {
            return $this->availableVendorIds;
        }
        $this->getAvailableVendors();
        $this->availableVendorIds = array_keys($this->availableVendors);
        return $this->availableVendorIds;
    }
    
    /**
     * Get first vendor ID
     * 
     * @return int
     */
    public function getFirstVendorId()
    {
        return current($this->getAvailableVendorIds());
    }
    
    /**
     * Get default vendor ID
     * 
     * @return int
     */
    public function getDefaultVendorId()
    {
        $vendorIds = $this->getAvailableVendorIds();
        return (in_array(\Ecombricks\Vendor\Model\Vendor::DEFAULT_ID, $vendorIds)) ? 
            \Ecombricks\Vendor\Model\Vendor::DEFAULT_ID : 
            current($vendorIds);
    }
    
    /**
     * Check if vendor ID is available
     * 
     * @param int $vendorId
     * @return bool
     */
    public function isVendorIdAvailable($vendorId)
    {
        return in_array($vendorId, $this->getAvailableVendorIds());
    }
    
    /**
     * Validate vendor ID
     * 
     * @param int $vendorId
     * @return bool
     */
    public function validateVendorId($vendorId)
    {
        return $this->isVendorIdAvailable($vendorId);
    }
    
    /**
     * Get vendor
     * 
     * @param int $vendorId
     * @return \Ecombricks\Vendor\Model\Vendor
     */
    public function getVendor($vendorId)
    {
        if (empty($vendorId)) {
            return null;
        }
        $this->getVendors();
        return (!empty($this->vendors[$vendorId])) ? $this->vendors[$vendorId] : null;
    }
    
    /**
     * Get vendor by code
     * 
     * @param string $code
     * @return \Ecombricks\Vendor\Model\Vendor
     */
    public function getVendorByCode($code)
    {
        if (empty($code)) {
            return null;
        }
        $this->getVendors();
        return (!empty($this->vendorsByCode[$code])) ? $this->vendorsByCode[$code] : null;
    }
    
    /**
     * Get vendor code
     * 
     * @param int $vendorId
     * @return string
     */
    public function getVendorCode($vendorId)
    {
        $vendor = $this->getVendor($vendorId);
        if (!$vendor) {
            return null;
        }
        return $vendor->getCode();
    }
    
    /**
     * Get vendor name
     * 
     * @param int $vendorId
     * @return string
     */
    public function getVendorName($vendorId)
    {
        $vendor = $this->getVendor($vendorId);
        if (!$vendor) {
            return null;
        }
        return $vendor->getName();
    }
    
    /**
     * Get available vendor options
     * 
     * @param bool $emptyOption
     * @return array
     */
    public function getAvailableVendorOptions($emptyOption = true)
    {
        $options = [];
        if ($emptyOption) {
            $options[] = ['label' => __('-- Select vendor --'), 'value' => ''];
        }
        foreach ($this->getAvailableVendors() as $vendor) {
            $options[] = ['label' => $vendor->getName(), 'value' => (int) $vendor->getVendorId()];
        }
        return $options;
    }
    
    /**
     * Get available vendors array
     * 
     * @return array
     */
    public function getAvailableVendorsArray()
    {
        $array = [];
        foreach ($this->getAvailableVendors() as $vendor) {
            $array[(int) $vendor->getVendorId()] = $vendor->getName();
        }
        return $array;
    }
    
    /**
     * Create vendor
     * 
     * @param array $vendorData
     * @return $this
     */
    public function createVendor($vendorData)
    {
        $vendorId = !empty($vendorData['vendor_id']) ? $vendorData['vendor_id'] : null;
        unset($vendorData['vendor_id']);
        $vendor = $this->vendorFactory->create();
        if ($vendorId) {
            $vendor->load($vendorId);
        }
        $vendor->fromArray($vendorData);
        $vendor->save();
        $this->clear();
        return $this;
    }
    
    /**
     * Create vendors
     * 
     * @param array $vendors
     * @return $this
     */
    public function createVendors($vendors)
    {
        foreach ($vendors as $vendorData) {
            $this->createVendor($vendorData);
        }
        return $this;
    }
    
    /**
     * Clear
     * 
     * @return $this
     */
    public function clear()
    {
        if ($this->vendors !== null) {
            $this->vendors = null;
        }
        if ($this->vendorsByCode !== null) {
            $this->vendorsByCode = null;
        }
        if ($this->availableVendors !== null) {
            $this->availableVendors = null;
        }
        if ($this->vendorIds !== null) {
            $this->vendorIds = null;
        }
        if ($this->availableVendorIds !== null) {
            $this->availableVendorIds = null;
        }
        return $this;
    }
    
}