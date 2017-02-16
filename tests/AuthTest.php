<?php

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    /**
     * @dataProvider payloadProvider
     */
    public function testSignPayload($username, $apiKey, $payload, $expected)
    {
        $auth = new \FTidemann\KeySms\Auth($username, $apiKey);

        $this->assertEquals($expected, $auth->signMessage($payload));
    }

    public function payloadProvider()
    {
        return [
            [
                'username',
                '123456789',
                [
                    'receivers' => [
                        555555,
                        666666
                    ],
                    'message' => 'test message'
                ],
                '62fb4608eb1563baead7fc50b4054a7f'
            ]
        ];
    }
}
