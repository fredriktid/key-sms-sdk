<?php

include_once __DIR__.'/../vendor/autoload.php';

$classLoader = new \Composer\Autoload\ClassLoader();
$classLoader->addPsr4("FTidemann\\KeySms\\", 'src', true);
$classLoader->register();
