<?php
namespace FTidemann\KeySms\Sms;

/**
 * Class Content
 * @package FTidemann\KeySms
 */
class Content
{
    /**
     * @var string
     */
    private $content;

    /**
     * Content constructor.
     * @param string $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

}
