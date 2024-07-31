<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

if (!\defined('APP_ROOT')) {
    \define('APP_ROOT', \realpath(__DIR__ . '/../'));
}

if (!\class_exists('Composer\Autoload\ClassLoader')) {
    $dir = __DIR__;
    $file = null;

    while (true) {
        if ('/' === $dir) {
            break;
        }

        $possibleFiles = [
            $dir . '/autoload.php',
            $dir . '/vendor/autoload.php',
            $dir . '/core/vendor/autoload.php',
        ];

        foreach ($possibleFiles as $possibleFile) {
            if (\file_exists($possibleFile)) {
                $file = $possibleFile;

                break 2;
            }
        }

        $dir = \dirname($dir);
    }

    if (null === $file) {
        throw new \RuntimeException('Unable to locate autoload.php file.');
    }

    require_once $file;
    unset($possibleFiles, $possibleFile, $file);
}
