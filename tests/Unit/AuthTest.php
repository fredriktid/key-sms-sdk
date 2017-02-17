<?php
namespace FTidemann\KeySms\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * @covers \FTidemann\KeySms\Auth
 */
class AuthTest extends TestCase
{
    /**
     * @dataProvider usernameProvider
     * @covers \FTidemann\KeySms\Auth::getUsername
     */
    public function testUsername($username, $apiKey, $expected)
    {
        $auth = new \FTidemann\KeySms\Auth($username, $apiKey);

        $this->assertEquals($expected, $auth->getUsername());
    }

    public function usernameProvider()
    {
        return [
            ['username', '9s827se6e5s4SE', 'username']
        ];
    }

    /**
     * @dataProvider signMessageProvider
     * @covers \FTidemann\KeySms\Auth::signMessage
     */
    public function testSignMessage($username, $apiKey, $message, $expected)
    {
        $auth = new \FTidemann\KeySms\Auth($username, $apiKey);

        $this->assertEquals($expected, $auth->signMessage($message));
    }

    public function signMessageProvider()
    {
        return [
            [
                'username',
                '123456789',
                [
                    'receivers' => [555555, 666666],
                    'message' => 'test message'
                ],
                '62fb4608eb1563baead7fc50b4054a7f'
            ],
            [
                'AnotherUser123',
                '9s827se6e5s4SE',
                [
                    'receivers' => [99887766, 22334422],
                    'message' => 'another message'
                ],
                '4a1a5530d2aefd176f69dfcb3c87499c'
            ],
        ];
    }
}
