<?php

namespace FTidemann\KeySms;

/**
 * Class Auth
 * @package FTidemann\KeySms
 */
class Auth
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Auth constructor.
     *
     * @param string $username
     * @param string $apiKey
     */
    public function __construct($username, $apiKey)
    {
        $this->username = $username;
        $this->apiKey = $apiKey;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sign the payload with the apiKey
     *
     * @param array $payload
     * @return string
     */
    public function signPayload(array $payload)
    {
        $hash = sprintf('%s%s', json_encode($payload), $this->apiKey);
        return md5($hash);
    }
}
