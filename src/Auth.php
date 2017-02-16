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
     * Sign the message with the apiKey
     *
     * @param array $message
     * @return string
     */
    public function signMessage(array $message)
    {
        $hash = sprintf('%s%s', json_encode($message), $this->apiKey);
        return md5($hash);
    }
}
