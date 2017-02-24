<?php
namespace FTidemann\KeySms\Tests\Unit;

use FTidemann\KeySms\Sms\Content;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FTidemann\KeySms\Sms\Content
 */
class ContentTest extends TestCase
{
    protected $content;

    protected function setUp()
    {
        $this->content = new Content('This is a message');
    }

    /**
     * @covers \FTidemann\KeySms\Sms\Content::getContent
     */
    public function testGetContent()
    {
        $this->assertTrue(is_string($this->content->getContent()));
    }
}
