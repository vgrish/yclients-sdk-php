<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Enums;

enum QueryParam: string
{
    case COUNT = 'count';
    case PAGE_SIZE = 'page_size';
    case PAGE = 'page';
    case FILTER = 'filter';
    case SEARCH = 'search';

    public function separator(): string
    {
        return self::matchSeparator($this);
    }

    public static function getSeparator(self|string $queryParam): string
    {
        if (\is_string($queryParam)) {
            try {
                $enumParam = self::from(\mb_strtolower($queryParam));
                $separator = $enumParam->separator();
            } catch (\Throwable) {
                $separator = '';
            }

            return $separator;
        }

        return self::matchSeparator($queryParam);
    }

    private static function matchSeparator(self $queryParam): string
    {
        return match ($queryParam) {
            self::FILTER => ';',
            default => '',
        };
    }
}
