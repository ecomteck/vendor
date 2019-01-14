<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorRobots\Framework\View\Result\Page;

/**
 * Robots result page
 */
class Robots extends \Magento\Framework\View\Result\Page
{
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory
     * @param \Magento\Framework\View\Layout\ReaderPool $layoutReaderPool
     * @param \Magento\Framework\Translate\InlineInterface $translateInline
     * @param \Magento\Framework\View\Layout\BuilderFactory $layoutBuilderFactory
     * @param \Magento\Framework\View\Layout\GeneratorPool $generatorPool
     * @param \Magento\Framework\View\Page\Config\RendererFactory $pageConfigRendererFactory
     * @param \Magento\Framework\View\Page\Layout\Reader $pageLayoutReader
     * @param bool $isIsolated
     * @return void
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\View\Layout\ReaderPool $layoutReaderPool,
        \Magento\Framework\Translate\InlineInterface $translateInline,
        \Magento\Framework\View\Layout\BuilderFactory $layoutBuilderFactory,
        \Magento\Framework\View\Layout\GeneratorPool $generatorPool,
        \Magento\Framework\View\Page\Config\RendererFactory $pageConfigRendererFactory,
        \Magento\Framework\View\Page\Layout\Reader $pageLayoutReader,
        $isIsolated = false
    )
    {
        $template = 'Magento_Robots::robots.phtml';
        parent::__construct(
            $context,
            $layoutFactory,
            $layoutReaderPool,
            $translateInline,
            $layoutBuilderFactory,
            $generatorPool,
            $pageConfigRendererFactory,
            $pageLayoutReader,
            $template,
            $isIsolated
        );
    }
    
}