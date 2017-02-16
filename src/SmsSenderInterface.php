<?php
namespace FTidemann\KeySms;

/**
 * Interface SmsSenderInterface
 * @package FTidemann\KeySms
 */
interface SmsSenderInterface
{
    /**
     * @return mixed
     */
    public function sendSms();
}
