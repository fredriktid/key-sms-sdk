# PHP SDK for KeySMS

A simple PHP SDK for [KeySMS](http://keysms.no/).

## Usage

```php
<?php

use FTidemann\KeySms\Auth;
use FTidemann\KeySms\Sms\Message;
use FTidemann\KeySms\Sms\Content;
use FTidemann\KeySms\Sms\Recipient;
use FTidemann\KeySms\Client;

$auth = new Auth('username', 'apiKey');

$message = new Message();
$message->setContent(new Content('Your message'));
$message->addRecipient(new Recipient('5555555'));
$message->addRecipient(new Recipient('6666666'));

$client= new Client($auth);
$client->setMessage($message);
$client->setHttpClient(new \Http\Adapter\Guzzle6\Client());
$client->send();

```