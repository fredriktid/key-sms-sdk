<?php
namespace FTidemann\KeySms\Tests\Unit;

use Http\Mock;
use FTidemann\KeySms;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FTidemann\KeySms\Client
 */
class ClientTest extends TestCase
{
    protected $message;

    protected function setUp()
    {
        $this->message = new KeySms\Sms\Message;
        $this->message->setContent(new KeySms\Sms\Content('A message'));
        $this->message->addRecipient(new KeySms\Sms\Recipient(11111111));
    }

    /**
     * @covers \FTidemann\KeySms\Client::getHttpClient
     * @covers \FTidemann\KeySms\Client::setHttpClient
     * @covers \FTidemann\KeySms\Client::setMessage
     * @covers \FTidemann\KeySms\Client::sendSms
     */
    public function testSendSms()
    {
        $response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')->getMock();
        $response->method('getStatusCode')->willReturn('200');
        $response->method('getBody')->willReturn(json_encode(['id' => 99]));

        $httpClientMock = new Mock\Client();
        $httpClientMock->addResponse($response);

        $authMock = $this->getMockBuilder('FTidemann\KeySms\Auth')
            ->setConstructorArgs(['username', 'apikey'])
            ->setMethods(['getUsername', 'signMessage'])
            ->getMock();

        $smsClient = new KeySms\Client($authMock);
        $smsClient->setHttpClient($httpClientMock);
        $smsClient->setMessage($this->message);

        $this->assertInstanceOf('FTidemann\KeySms\SmsSenderInterface', $smsClient);
        $this->assertInstanceOf('Http\Client\HttpClient', $smsClient->getHttpClient());

        $response = $smsClient->sendSms();

        $this->assertInstanceOf('Psr\Http\Message\ResponseInterface', $response);
        $this->assertJsonStringEqualsJsonString(json_encode(['id' => 99]), $response->getBody());
        $this->assertEquals('200', $response->getStatusCode());
    }
}
