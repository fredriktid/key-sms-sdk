<?php
namespace FTidemann\KeySms\Sms;

/**
 * Class Recipient
 * @package FTidemann\KeySms
 */
class Recipient
{
    /**
     * @var integer
     */
    private $number;

    /**
     * Recipient constructor.
     * @param mixed $number
     */
    public function __construct($number)
    {
        $this->number = (string)$number;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }
}
