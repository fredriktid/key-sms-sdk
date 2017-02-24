<?php
namespace FTidemann\KeySms\Tests\Unit;

use FTidemann\KeySms\Sms\Recipient;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FTidemann\KeySms\Sms\Recipient
 */
class RecipientTest extends TestCase
{
    protected $recipients = [];

    protected $phoneNumbers = [
        '+47 22 33 44 55',
        '0047 23 33 44 55',
        11223344,
        32211223,
        null
    ];

    protected function setUp()
    {
        foreach ($this->phoneNumbers as $phoneNumber) {
            $this->recipients[] = new Recipient($phoneNumber);
        }
    }

    /**
     * @covers \FTidemann\KeySms\Sms\Recipient::getNumber
     */
    public function testRecipientType()
    {
        /** @var Recipient $recipient */
        foreach ($this->recipients as $recipient) {
            $this->assertTrue(is_string($recipient->getNumber()));
        }
    }
}
