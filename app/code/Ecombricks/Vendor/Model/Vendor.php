<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Model;

/**
 * Vendor model
 */
class Vendor extends \Ecombricks\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    
    /**
     * Entity code
     */
    const ENTITY = 'vendor';
    
    /**
     * Cache tag
     */
    const CACHE_TAG = 'vendor';
    
    /**
     * Field keys
     */
    const VENDOR_ID = 'vendor_id';
    const CODE = 'code';
    const NAME = 'name';
    const SHORT_DESCRIPTION = 'short_description';
    const DESCRIPTION = 'description';
    const META_TITLE = 'meta_title';
    const META_KEYWORDS = 'meta_keywords';
    const META_DESCRIPTION = 'meta_description';
    const LOGO = 'logo';
    const IS_ACTIVE = 'is_active';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    /**
     * Default ID
     */
    const DEFAULT_ID = 1;
    
    /**
     * Cache tag
     * 
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;
    
    /**
     * Event prefix
     * 
     * @var string
     */
    protected $_eventPrefix = 'vendor';
    
    /**
     * Event object
     * 
     * @var string
     */
    protected $_eventObject = 'vendor';
    
    /**
     * URL builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;
    
    /**
     * Logo
     * 
     * @var \Ecombricks\Vendor\Model\Vendor\Image
     */
    protected $logo;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Filter\FilterManager $filterManager
     * @param \Ecombricks\Vendor\Model\Vendor\Validator $validator
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Filter\FilterManager $filterManager,
        \Ecombricks\Vendor\Model\Vendor\Validator $validator,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    )
    {
        $this->validator = $validator;
        $this->urlBuilder = $urlBuilder;
        parent::__construct(
            $context,
            $registry,
            $filterManager,
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
        $this->_init(\Ecombricks\Vendor\Model\ResourceModel\Vendor::class);
        $this->setDefaultData(['is_active' => 1]);
        parent::_construct();
    }
    
    /**
     * Get vendor id
     * 
     * @return int|null
     */
    public function getVendorId()
    {
        return $this->getData(self::VENDOR_ID);
    }
    
    /**
     * Set vendor id
     * 
     * @param int|null $vendorId
     * @return $this
     */
    public function setVendorId($vendorId)
    {
        return $this->setData(self::VENDOR_ID, $vendorId);
    }
    
    /**
     * Check if default
     * 
     * @return bool
     */
    public function isDefault()
    {
        return $this->getVendorId() == self::DEFAULT_ID;
    }
    
    /**
     * Get code
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->getData(self::CODE);
    }
    
    /**
     * Set code
     *
     * @param string|null $code
     * @return $this
     */
    public function setCode($code)
    {
        return $this->setData(self::CODE, $code);
    }
    
    /**
     * Get name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }
    
    /**
     * Set name
     *
     * @param string|null $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }
    
    /**
     * Get short description
     *
     * @return string|null
     */
    public function getShortDescription()
    {
        return $this->getData(self::SHORT_DESCRIPTION);
    }
    
    /**
     * Set short description
     *
     * @param string|null $shortDescription
     * @return $this
     */
    public function setShortDescription($shortDescription)
    {
        return $this->setData(self::SHORT_DESCRIPTION, $shortDescription);
    }
    
    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }
    
    /**
     * Set description
     *
     * @param string|null $description
     * @return $this
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }
    
    /**
     * Get meta title
     *
     * @return string|null
     */
    public function getMetaTitle()
    {
        return $this->getData(self::META_TITLE);
    }
    
    /**
     * Set meta title
     * 
     * @param string|null $metaTitle
     * @return $this
     */
    public function setMetaTitle($metaTitle)
    {
        return $this->setData(self::META_TITLE, $metaTitle);
    }
    
    /**
     * Get meta keywords
     *
     * @return string|null
     */
    public function getMetaKeywords()
    {
        return $this->getData(self::META_KEYWORDS);
    }
    
    /**
     * Set meta keywords
     * 
     * @param string|null $metaKeywords
     * @return $this
     */
    public function setMetaKeywords($metaKeywords)
    {
        return $this->setData(self::META_KEYWORDS, $metaKeywords);
    }
    
    /**
     * Get meta description
     *
     * @return string|null
     */
    public function getMetaDescription()
    {
        return $this->getData(self::META_DESCRIPTION);
    }
    
    /**
     * Set meta description
     * 
     * @param string|null $metaDescription
     * @return $this
     */
    public function setMetaDescription($metaDescription)
    {
        return $this->setData(self::META_DESCRIPTION, $metaDescription);
    }
    
    /**
     * Get logo
     * 
     * @return string|null
     */
    public function getLogo()
    {
        return $this->getData(self::LOGO);
    }
    
    /**
     * Set logo
     * 
     * @param string|null $logo
     * @return $this
     */
    public function setLogo($logo)
    {
        return $this->setData(self::LOGO, $logo);
    }
    
    /**
     * Get is active
     * 
     * @return int|null
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }
    
    /**
     * Set is active
     * 
     * @param int|null $isActive
     * @return $this
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }
    
    /**
     * Check if is active
     * 
     * @return bool
     */
    public function isActive()
    {
        return ($this->getIsActive()) ? true : false;
    }
    
    /**
     * Get created at
     * 
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }
    
    /**
     * Set created at
     * 
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
    
    /**
     * Get updated at
     * 
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }
    
    /**
     * Set updated at
     * 
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
    
    /**
     * Get URL
     * 
     * @return string
     */
    public function getUrl()
    {
        return $this->urlBuilder->getUrl('vendors/vendor/view', [ 'code' => $this->getCode() ]);
    }
    
    /**
     * Get edit URL
     * 
     * @return string
     */
    public function getEditUrl()
    {
        return $this->urlBuilder->getUrl('vendor/vendor/edit', [ 'vendor_id' => $this->getVendorId() ]);
    }
    
    /**
     * Filter
     * 
     * @return $this
     */
    protected function filter()
    {
        $this->setCode($this->filterString($this->getCode()));
        $this->setName($this->filterString($this->getName()));
        $this->setMetaTitle($this->filterString($this->getMetaTitle()));
        $this->setMetaKeywords($this->filterString($this->getMetaKeywords()));
        $this->setMetaDescription($this->filterString($this->getMetaDescription()));
        return $this;
    }
    
    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        $identities = [ self::CACHE_TAG.'_'.$this->getVendorId() ];
        if ($this->_appState->getAreaCode() == \Magento\Framework\App\Area::AREA_FRONTEND) {
            $identities[] = self::CACHE_TAG;
        }
        return array_unique($identities);
    }
    
    /**
     * Before delete
     * 
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function beforeDelete()
    {
        if ($this->isDefault()) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Can\'t delete the default vendor.'));
        }
        parent::beforeDelete();
        return $this;
    }
    
}