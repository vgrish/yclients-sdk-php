<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Services;

final class Url
{
    public static function convertMixedValueToString(array|bool|float|int|string $value): string
    {
        if (\is_bool($value)) {
            return \var_export($value, true);
        }

        if (\is_array($value)) {
            return '[' . \implode(',', \array_map(self::convertMixedValueToString(...), $value)) . ']';
        }

        return (string) $value;
    }
}
