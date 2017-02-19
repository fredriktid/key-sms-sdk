<?php
namespace FTidemann\KeySms\Tests\Unit;

use FTidemann\KeySms\Sms\Recipient;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FTidemann\KeySms\Sms\Message
 */
class MessageTest extends TestCase
{
    protected $phoneNumbers = [
        22332233,
        '+47 23 32 12',
        '0454 22 333 444'
    ];

    protected $recipients = [];

    protected function setUp()
    {
        foreach ($this->phoneNumbers as $phoneNumber) {
            $this->recipients[] = new Recipient($phoneNumber);
        }
    }

    /**
     * @covers \FTidemann\KeySms\Sms\Message::addRecipient
     * @covers \FTidemann\KeySms\Sms\Message::getRecipients
     */
    public function testAddRecipients()
    {
        $message = new \FTidemann\KeySms\Sms\Message;
        foreach ($this->recipients as $recipient) {
            $message->addRecipient($recipient);
        }

        $this->assertEquals($this->recipients, $message->getRecipients());
        $this->assertFalse(empty($message->getRecipients()));
    }


    /**
     * @covers \FTidemann\KeySms\Sms\Message::getRecipientNumbers
     */
    public function testGetRecipientNumbers()
    {
        $message = new \FTidemann\KeySms\Sms\Message;
        foreach ($this->recipients as $recipient) {
            $message->addRecipient($recipient);
        }

        $this->assertEquals($this->phoneNumbers, $message->getRecipientNumbers());
        $this->assertFalse(empty($message->getRecipientNumbers()));
    }

    /**
     * @covers \FTidemann\KeySms\Sms\Message::createMessage
     * @covers \FTidemann\KeySms\Sms\Message::getContent
     * @covers \FTidemann\KeySms\Sms\Message::setContent
     * @covers \FTidemann\KeySms\Sms\Message::encodeMessage
     */
    public function testCreateMessage()
    {
        $message = new \FTidemann\KeySms\Sms\Message;
        $message->setContent(new \FTidemann\KeySms\Sms\Content('A message'));
        foreach ($this->recipients as $recipient) {
            $message->addRecipient($recipient);
        }

        $content = $message->getContent();
        $this->assertInstanceOf('FTidemann\KeySms\Sms\Content', $content);

        $expected = [
            'receivers' => array_map('strval', $this->phoneNumbers),
            'message' => 'A message'
        ];

        $this->assertEquals($expected, $message->createMessage());
        $this->assertEquals(json_encode($expected), $message->encodeMessage($message->createMessage()));
    }
}
