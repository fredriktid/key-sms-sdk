<?php
namespace FTidemann\KeySms\Tests;

use FTidemann\KeySms\Sms\Recipient;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    /**
     * @dataProvider addRecipientsProvider
     */
    public function testAddRecipients($recipients, $expected)
    {
        $message = new \FTidemann\KeySms\Sms\Message;
        foreach ($recipients as $recipient) {
            $message->addRecipient($recipient);
        }

        $this->assertEquals($expected, $message->getRecipients());
    }

    public function addRecipientsProvider()
    {
        $recipientList = [
            new \FTidemann\KeySms\Sms\Recipient('test@example.com'),
            new \FTidemann\KeySms\Sms\Recipient('another@test.com'),
            new \FTidemann\KeySms\Sms\Recipient('Yet@anothertest.com')
        ];

        return [
            [
                $recipientList,
                $recipientList
            ],
            [
                [],
                []
            ]
        ];
    }

    /**
     * @dataProvider flattenRecipientsProvider
     */
    public function testFlattenRecipients($recipients, $expected)
    {
        $message = new \FTidemann\KeySms\Sms\Message;
        foreach ($recipients as $recipient) {
            $message->addRecipient($recipient);
        }

        $this->assertEquals($expected, $message->flattenRecipients());
    }

    public function flattenRecipientsProvider()
    {
        return [
            [
                [
                    new \FTidemann\KeySms\Sms\Recipient('test@example.com'),
                    new \FTidemann\KeySms\Sms\Recipient('another@test.com'),
                    new \FTidemann\KeySms\Sms\Recipient('Yet@anothertest.com')
                ],
                [
                    'test@example.com',
                    'another@test.com',
                    'Yet@anothertest.com'
                ]
            ]
        ];
    }

    /**
     * @dataProvider createMessageProvider
     */
    public function testCreateMessage($content, $recipients, $expected)
    {
        $message = new \FTidemann\KeySms\Sms\Message;
        $message->setContent($content);
        foreach ($recipients as $recipient) {
            $message->addRecipient($recipient);
        }

        $this->assertEquals($expected, $message->createMessage());
    }

    public function createMessageProvider()
    {
        return [
            [
                new \FTidemann\KeySms\Sms\Content('A message'),
                [
                    new \FTidemann\KeySms\Sms\Recipient('a.recipient@example.com'),
                    new \FTidemann\KeySms\Sms\Recipient('another.recipient@example.com')
                ],
                [
                    'message' => 'A message',
                    'receivers' => [
                        'a.recipient@example.com',
                        'another.recipient@example.com'
                    ]
                ]
            ]
        ];
    }
}
