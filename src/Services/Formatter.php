<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Services;

final class Formatter
{
    public static function extractData(mixed $data): mixed
    {
        $rows = $data;

        if (\is_object($data) && \method_exists($data, 'toArray')) {
            $rows = $data->toArray();
        } elseif (\is_array($data) && isset($data[0])) {
            $rows = [];

            foreach ($data as $item) {
                if (\is_object($item) && \method_exists($item, 'toArray')) {
                    $rows[] = $item->toArray();
                } else {
                    $rows[] = $item;
                }
            }
        }

        return $rows;
    }
}
