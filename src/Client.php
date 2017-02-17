<?php
namespace FTidemann\KeySms;

use FTidemann\KeySms\Sms\Message;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\MessageFactory;
use Psr\Http\Message\ResponseInterface;
use Http\Client\Exception as HttpClientException;
use Psr\Log\LoggerInterface;

/**
 * Class Client
 * @package FTidemann\KeySms
 */
class Client implements SmsSenderInterface
{
    /**
     * @var Auth
     */
    private $auth;

    /**
     * @var Message
     */
    private $message;

    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private static $endpoint = 'https://app.keysms.no';

    /**
     * Client constructor.
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Message $message
     * @return $this
     */
    public function setMessage(Message $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param LoggerInterface $logger
     * @return $this
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @return MessageFactory
     */
    private function getMessageFactory()
    {
        if (null === $this->messageFactory) {
            $this->messageFactory = MessageFactoryDiscovery::find();
        }

        return $this->messageFactory;
    }

    /**
     * @param HttpClient|null $httpClient
     * @return $this
     */
    public function setHttpClient(HttpClient $httpClient = null)
    {
        if (null !== $httpClient) {
            $this->httpClient = $httpClient;
            return $this;
        }

        $this->httpClient = HttpClientDiscovery::find();
        return $this;
    }

    /**
     * Sends SMS
     *
     * @return ResponseInterface
     */
    public function sendSms()
    {
        $message = $this->message->createMessage();

        $response = $this->sendRequest('/messages', $this->message->encodeMessage([
            'payload' => $message,
            'signature' => $this->auth->signMessage($message),
            'username' => $this->auth->getUsername()
        ]));

        if (null !== $this->logger) {
            $this->logger->info('SMS sent: '.$response->getBody());
        }

        return $response;
    }

    /**
     * Send request
     *
     * @param string $path
     * @param mixed $data
     * @throws HttpClientException
     * @throws \Exception
     * @return ResponseInterface
     */
    private function sendRequest($path, $data)
    {
        $request = $this->getMessageFactory()->createRequest('POST', self::$endpoint.$path, [], $data);
        return $this->httpClient->sendRequest($request);
    }
}
