<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Framework\Plugin;

/**
 * Abstract plugin
 */
class AbstractPlugin
{
    
    /**
     * Subject
     * 
     * @var object
     */
    protected $subject;
    
    /**
     * Set subject
     * 
     * @param object $subject
     * @return $this
     */
    protected function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }
    
    /**
     * Get subject
     * 
     * @return object
     */
    protected function getSubject()
    {
        if (empty($this->subject)) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Subject is undefined for the plugin.'));
        }
        return $this->subject;
    }
    
}