# PHP SDK for KeySMS


[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fredriktid/key-sms-sdk/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fredriktid/key-sms-sdk/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/fredriktid/key-sms-sdk/badges/build.png?b=master)](https://scrutinizer-ci.com/g/fredriktid/key-sms-sdk/build-status/master)

A simple PHP SDK for [KeySMS](http://keysms.no/).

## Install

```
composer require fredriktid/key-sms-sdk
```

## Usage

```php
<?php

use \FTidemann\KeySms;

$auth = new KeySms\Auth('username', 'apiKey');

$message = new KeySms\Sms\Message();
$message->setContent(new KeySms\Sms\Content('Your message'));
$message->addRecipient(new KeySms\Sms\Recipient(55555555));
$message->addRecipient(new KeySms\Sms\Recipient(66666666));

$client= new KeySms\Client($auth);
$client->setMessage($message);
$client->setHttpClient(new \Http\Adapter\Guzzle6\Client());
$client->sendSms();

```
