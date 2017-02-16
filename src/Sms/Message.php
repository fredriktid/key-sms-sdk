<?php
namespace FTidemann\KeySms\Sms;

/**
 * Class Message
 * @package FTidemann\KeySms
 */
class Message
{
    /**
     * @var Content
     */
    private $content;

    /**
     * @var array
     */
    private $recipents = [];

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param Content $content
     */
    public function setContent(Content $content)
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipents;
    }

    /**
     * @param Recipient $recipient
     */
    public function addRecipient(Recipient $recipient)
    {
        $this->recipents[] = $recipient;
    }

    /**
     * @return array
     */
    public function createMessage()
    {
        return [
            'message' => $this->content->getContent(),
            'receivers' => $this->recipents
        ];
    }

    /**
     * @param array $message
     * @return string
     */
    public function encodeMessage(array $message)
    {
        return json_encode($message);
    }
}
