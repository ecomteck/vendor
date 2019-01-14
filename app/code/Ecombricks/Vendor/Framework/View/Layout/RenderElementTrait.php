<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\View\Layout;

/**
 * Layout render element trait
 */
trait RenderElementTrait
{
    
    /**
     * Render container
     * 
     * @param string $name
     * @param bool $useCache
     * @return string
     */
    protected function vendorRenderContainer($name, $useCache = true)
    {
        $html = '';
        $children = $this->getChildNames($name);
        foreach ($children as $child) {
            $html .= $this->renderElement($child, $useCache);
        }
        if ($html == '' || !$this->structure->getAttribute($name, \Magento\Framework\View\Layout\Element::CONTAINER_OPT_HTML_TAG)) {
            return $html;
        }
        $htmlId = $this->structure->getAttribute($name, \Magento\Framework\View\Layout\Element::CONTAINER_OPT_HTML_ID);
        if ($htmlId) {
            $htmlId = ' id="' . $htmlId . '"';
        }
        $htmlClass = $this->structure->getAttribute($name, \Magento\Framework\View\Layout\Element::CONTAINER_OPT_HTML_CLASS);
        if ($htmlClass) {
            $htmlClass = ' class="' . $htmlClass . '"';
        }
        $htmlTag = $this->structure->getAttribute($name, \Magento\Framework\View\Layout\Element::CONTAINER_OPT_HTML_TAG);
        $html = sprintf('<%1$s%2$s%3$s>%4$s</%1$s>', $htmlTag, $htmlId, $htmlClass, $html);
        return $html;
    }
    
    /**
     * Render non cached element
     * 
     * @param string $name
     * @param bool $useCache
     * @return string
     * @throws \Exception
     */
    protected function vendorRenderNonCachedElement($name, $useCache = true)
    {
        $result = '';
        try {
            if ($this->isUiComponent($name)) {
                $result = $this->_renderUiComponent($name);
            } elseif ($this->isBlock($name)) {
                $result = $this->_renderBlock($name);
            } else {
                $result = $this->vendorRenderContainer($name, $useCache);
            }
        } catch (\Exception $e) {
            if ($this->appState->getMode() === \Magento\Framework\App\State::MODE_DEVELOPER) {
                throw $e;
            }
            $message = ($e instanceof \Magento\Framework\Exception\LocalizedException) ? 
                $e->getLogMessage() : $e->getMessage();
            $this->logger->critical($message);
        }
        return $result;
    }
    
    /**
     * Render element
     *
     * @param string $name
     * @param bool $useCache
     * @return string
     */
    public function vendorRenderElement($name, $useCache = true)
    {
        $this->build();
        if (!isset($this->_renderElementCache[$name]) || !$useCache) {
            if ($this->displayElement($name)) {
                $this->_renderElementCache[$name] = $this->vendorRenderNonCachedElement($name, $useCache);
            } else {
                return $this->_renderElementCache[$name] = '';
            }
        }
        $this->_renderingOutput->setData('output', $this->_renderElementCache[$name]);
        $this->_eventManager->dispatch(
            'core_layout_render_element',
            ['element_name' => $name, 'layout' => $this, 'transport' => $this->_renderingOutput]
        );
        return $this->_renderingOutput->getData('output');
    }
    
}