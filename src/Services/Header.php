<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Services;

use Vgrish\Yclients\Yclients;

final class Header
{
    public const HEADERS = [
        'accept' => 'application/vnd.yclients.v2+json',
        'content_type' => 'application/json',
    ];
    public const AUTH_BEARER = 'Bearer';
    public const AUTH_USER = 'User';

    public static function get(string $key): string
    {
        return self::HEADERS[$key] ?? '';
    }

    public static function getAuthorization(Yclients $yclients, array $spec): string
    {
        $auth = [];

        if (\str_contains($spec['desc'], 'partner_token')) {
            $auth[] = \sprintf('%s %s', self::AUTH_BEARER, $yclients->getPartnerToken());
        }

        if (\str_contains($spec['desc'], 'user_token')) {
            $auth[] = \sprintf('%s %s', self::AUTH_USER, $yclients->getUserToken());
        }

        return \implode(',', $auth);
    }
}
