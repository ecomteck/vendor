<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorTheme\Plugin\Block\Html;

/**
 * Top menu block plugin
 */
class Topmenu extends \Ecombricks\Framework\Plugin\AbstractPlugin
{
    
    /**
     * URL builder
     * 
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;
    
    /**
     * Request
     * 
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Framework\App\RequestInterface $request
     * @return void
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\App\RequestInterface $request
    )
    {
        $this->urlBuilder = $urlBuilder;
        $this->request = $request;
    }
    
    /**
     * Check if vendors page is active
     * 
     * @return bool
     */
    protected function isVendorsPageActive()
    {
        $moduleName = $this->request->getModuleName();
        return substr($moduleName, 0, 6) === 'vendor';
    }
    
    /**
     * Add vendors page note
     * 
     * @param \Magento\Framework\Data\Tree\Node $menu
     * @return $this
     */
    protected function addVendorsPageNode()
    {
        $menu = $this->getSubject()->getMenu();
        $node = new \Magento\Framework\Data\Tree\Node(
            [
                'id' => 'vendors-node',
                'name' => __('Vendors'),
                'url' => $this->urlBuilder->getUrl('vendors/vendor/index'),
                'has_active' => false,
                'is_active' => $this->isVendorsPageActive()
            ],
            'id',
            $menu->getTree(),
            $menu
        );
        $menu->addChild($node);
        return $this;
    }
    
    /**
     * Add vendors identity
     * 
     * @return $this
     */
    protected function addVendorsIdentity()
    {
        $this->getSubject()->addIdentity('vendors');
        return $this;
    }
    
    /**
     * Around get HTML
     * 
     * @param \Magento\Theme\Block\Html\Topmenu $subject
     * @param \Closure $proceed
     * @param string $outermostClass
     * @param string $childrenWrapClass
     * @param int $limit
     * @return string
     */
    public function aroundGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
        \Closure $proceed,
        $outermostClass = '',
        $childrenWrapClass = '',
        $limit = 0
    )
    {
        $this->setSubject($subject);
        $this->addVendorsPageNode();
        return $proceed($outermostClass, $childrenWrapClass, $limit);
    }
    
    /**
     * Get identities
     * 
     * @param \Magento\Theme\Block\Html\Topmenu $subject
     * @param \Closure $proceed
     * @return array
     */
    public function aroundGetIdentities(
        \Magento\Theme\Block\Html\Topmenu $subject,
        \Closure $proceed
    )
    {
        $this->setSubject($subject);
        $this->addVendorsIdentity();
        return $proceed();
    }
    
}