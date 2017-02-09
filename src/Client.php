<?php

namespace FTidemann\KeySms;

use FTidemann\KeySms\Sms\Message;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;

/**
 * Class Client
 * @package FTidemann\KeySms
 */
class Client
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
     * @var HttpClient
     */
    private $httpClient;

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

    public function send()
    {
        // TODO
    }
}
