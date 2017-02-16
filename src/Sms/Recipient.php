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
     * @param integer $number
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }
}
