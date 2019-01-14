<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Version\Model\Developer\Logger\Handler\Debug;

/**
 * Debug logger handler
 */
class Proxy extends \Magento\Developer\Model\Logger\Handler\Debug
{

    /**
     * Subject
     * 
     * @var \Magento\Developer\Model\Logger\Handler\Debug
     */
    protected $_subject;

    /**
     * Object manager
     * 
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * Constructor
     * 
     * @param \Magento\Framework\ObjectManagerInterface $objectManger
     * @return void
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManger)
    {
        $this->_objectManager = $objectManger;
    }

    /**
     * Get subject
     *
     * @return \Magento\Developer\Model\Logger\Handler\Debug
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = $this->_objectManager->get(\Magento\Developer\Model\Logger\Handler\Debug::class);
        }
        return $this->_subject;
    }

    /**
     * {@inheritDoc}
     */
    public function write(array $record)
    {
        return $this->_getSubject()->write($record);
    }

    /**
     * {@inheritdoc}
     */
    public function handle(array $record)
    {
        return $this->_getSubject()->handle($record);
    }

    /**
     * {@inheritdoc}
     */
    public function isHandling(array $record)
    {
        return $this->_getSubject()->isHandling($record);
    }

    /**
     * {@inheritdoc}
     */
    public function handleBatch(array $records)
    {
        return $this->_getSubject()->handleBatch($records);
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        return $this->_getSubject()->close();
    }

    /**
     * {@inheritdoc}
     */
    public function pushProcessor($callback)
    {
        return $this->_getSubject()->pushProcessor($callback);
    }

    /**
     * {@inheritdoc}
     */
    public function popProcessor()
    {
        return $this->_getSubject()->popProcessor();
    }

    /**
     * {@inheritdoc}
     */
    public function setFormatter(\Monolog\Formatter\FormatterInterface $formatter)
    {
        return $this->_getSubject()->setFormatter($formatter);
    }

    /**
     * {@inheritdoc}
     */
    public function getFormatter()
    {
        return $this->_getSubject()->getFormatter();
    }

    /**
     * {@inheritdoc}
     */
    public function setLevel($level)
    {
        return $this->_getSubject()->setLevel($level);
    }

    /**
     * {@inheritdoc}
     */
    public function getLevel()
    {
        return $this->_getSubject()->getLevel();
    }

    /**
     * {@inheritdoc}
     */
    public function setBubble($bubble)
    {
        return $this->_getSubject()->setBubble($bubble);
    }

    /**
     * {@inheritdoc}
     */
    public function getBubble()
    {
        return $this->_getSubject()->getBubble();
    }

}