<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Model\Vendor\VendorList;

/**
 * Vendor list toolbar model
 */
class Toolbar
{
    
    /**
     * Page param name
     */
    const PAGE_PARM_NAME = 'p';
    
    /**
     * Order param name
     */
    const ORDER_PARAM_NAME = 'vendor_list_order';
    
    /**
     * Direction param name
     */
    const DIRECTION_PARAM_NAME = 'vendor_list_dir';
    
    /**
     * Limit param name
     */
    const LIMIT_PARAM_NAME = 'vendor_list_limit';
    
    /**
     * Request
     *
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\App\Request\Http $request
     * @return void
     */
    public function __construct(\Magento\Framework\App\Request\Http $request)
    {
        $this->request = $request;
    }

    /**
     * Get order
     *
     * @return string|bool
     */
    public function getOrder()
    {
        return $this->request->getParam(self::ORDER_PARAM_NAME);
    }
    
    /**
     * Get direction
     *
     * @return string|bool
     */
    public function getDirection()
    {
        return $this->request->getParam(self::DIRECTION_PARAM_NAME);
    }
    
    /**
     * Get limit
     *
     * @return string|bool
     */
    public function getLimit()
    {
        return $this->request->getParam(self::LIMIT_PARAM_NAME);
    }
    
    /**
     * Get current page
     * 
     * @return int
     */
    public function getCurrentPage()
    {
        $page = (int) $this->request->getParam(self::PAGE_PARM_NAME);
        return $page ? $page : 1;
    }
    
}