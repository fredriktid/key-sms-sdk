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
    private $recipients = [];

    /**
     * @return Content
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
        return $this->recipients;
    }

    /**
     * @return array
     */
    public function getRecipientNumbers()
    {
        $recipients = [];

        /** @var Recipient $recipient */
        foreach ($this->getRecipients() as $recipient) {
            $recipients[] = $recipient->getNumber();
        }

        return $recipients;
    }

    /**
     * @param Recipient $recipient
     */
    public function addRecipient(Recipient $recipient)
    {
        $this->recipients[] = $recipient;
    }

    /**
     * @return array
     */
    public function createMessage()
    {
        return [
            'receivers' => $this->getRecipientNumbers(),
            'message' => $this->content->getContent()
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
