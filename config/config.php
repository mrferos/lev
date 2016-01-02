<?php

use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\ArrayObject;

$config = [];

foreach(glob(__DIR__ . DIRECTORY_SEPARATOR . 'autoload' . DIRECTORY_SEPARATOR . '*.php') as $configFile)
{
    $config = ArrayUtils::merge($config, include $configFile);
}

return new ArrayObject($config);