<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Ui\App\Response;

/**
 * Response data object
 */
class DataObject extends \Magento\Framework\DataObject
{
    
    /**
     * Constructor
     * 
     * @param array $data
     * @return void
     */
    public function __construct(array $data = [])
    {
        if (!array_key_exists('messages', $data)) {
            $data['messages'] = [];
        }
        if (!array_key_exists('error', $data)) {
            $data['error'] = false;
        }
        parent::__construct($data);
    }
    
    /**
     * Append message
     * 
     * @param \Magento\Framework\Phrase|string $message
     * @return $this
     */
    public function appendMessage($message)
    {
        if (is_array($message)) {
            foreach ($message as $_message) {
                $this->appendMessage($_message);
            }
        }
        $messagePhrase = $message instanceof \Magento\Framework\Phrase ? $message : new \Magento\Framework\Phrase($message);
        if ($this->getMessageContainer()) {
            $messagePhrase = new \Magento\Framework\Phrase($this->getMessageContainer(), [ $messagePhrase ]);
        }
        $this->setMessages(array_merge($this->getMessages(), [ $messagePhrase ]));
        return $this;
    }
    
    /**
     * Append response messages
     * 
     * @param \Magento\Framework\DataObject $response
     * @return $this
     */
    public function appendResponseMessages($response)
    {
        $messages = $response->getMessages();
        if (count($messages)) {
            foreach ($messages as $message) {
                $this->appendMessage($message);
            }
        }
        $message = $response->getMessage();
        if ($message) {
            $this->appendMessage($message);
        }
        return $this;
    }
    
    /**
     * Merge response
     * 
     * @param \Magento\Framework\DataObject $response
     * @return $this
     */
    public function mergeResponse($response)
    {
        if ($response->getError() === true) {
            $this->setError(true);
        }
        $this->appendResponseMessages($response);
        return $this;
    }
    
    /**
     * Reset
     * 
     * @return $this
     */
    public function reset()
    {
        $this->setMessages([]);
        $this->setError(false);
        return $this;
    }
    
}