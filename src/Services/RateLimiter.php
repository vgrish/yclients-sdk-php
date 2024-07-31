<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Services;

final class RateLimiter
{
    private static ?RateLimiter $instance = null;
    private static ?float $lastRequestTime = null;
    private static int $requestsPerSecond;

    private function __construct(int $requestsPerSecond)
    {
        self::$requestsPerSecond = $requestsPerSecond;
    }

    public static function getInstance(int $requestsPerSecond): self
    {
        if (null === self::$instance) {
            self::$instance = new self($requestsPerSecond);
        }

        return self::$instance;
    }

    public static function check(): void
    {
        $currentTime = \microtime(true);

        if (null !== self::$lastRequestTime) {
            $timePassed = $currentTime - self::$lastRequestTime;
            $rateLimit = 1 / self::$requestsPerSecond;

            if ($timePassed < $rateLimit) {
                $sleepTime = (int) (($rateLimit - $timePassed) * 1000000);
                \usleep($sleepTime);
            }
        }

        self::$lastRequestTime = \microtime(true);
    }
}
