<?php
namespace FTidemann\KeySms;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface SmsSenderInterface
 * @package FTidemann\KeySms
 */
interface SmsSenderInterface
{
    /**
     * Sends SMS
     *
     * @return ResponseInterface
     */
    public function sendSms();
}
