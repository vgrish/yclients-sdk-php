<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Services;

use Vgrish\Yclients\Enums\QueryParam;

final class QueryParams
{
    public static function setSearch(array $params, string $text): array
    {
        return self::set($params, QueryParam::SEARCH->value, $text);
    }

    public static function setPageSize(array $params, int $limit): array
    {
        return self::set($params, QueryParam::PAGE_SIZE, \max($limit, 1));
    }

    public static function setCount(array $params, int $limit): array
    {
        return self::set($params, QueryParam::COUNT, \max($limit, 1));
    }

    public static function setPage(array $params, int $offset): array
    {
        return self::set($params, QueryParam::PAGE, \max($offset, 1));
    }

    public static function setParam(
        array $params,
        array|int|string $key,
        null|array|bool|float|int|string $value = null,
    ): array {
        if (\is_array($key)) {
            return self::handleArrayOfParams($params, $key);
        }

        if (null === $value) {
            throw new \InvalidArgumentException("Value can't be null for the key '{$key}'");
        }

        return self::set($params, $key, $value);
    }

    private static function handleArrayOfParams(array $params, array $settableParams): array
    {
        if (!self::isAssociativeArray($settableParams)) {
            foreach ($settableParams as $param) {
                $params = self::setParam($params, ...$param);
            }
        } else {
            foreach ($settableParams as $key => $param) {
                if (\is_string($key)) {
                    $params = self::set($params, $key, $param);
                } else {
                    $params = self::setParam($params, ...$param);
                }
            }
        }

        return $params;
    }

    private static function set(
        array $params,
        QueryParam|string $queryParam,
        array|bool|float|int|string $value,
    ): array {
        $queryParam = \is_object($queryParam) ? $queryParam->value : $queryParam;
        $stringValue = Url::convertMixedValueToString($value);

        $separator = QueryParam::getSeparator($queryParam);

        if ('' === $separator) {
            $params[$queryParam] = $stringValue;

            return $params;
        }

        if (!\array_key_exists($queryParam, $params)) {
            $params[$queryParam] = '';
        }

        $params[$queryParam] .= '' === $params[$queryParam] ?
            $stringValue :
            $separator . $stringValue;

        return $params;
    }

    private static function isAssociativeArray(array $array): bool
    {
        if ([] === $array) {
            return false;
        }

        return \array_keys($array) !== \range(0, \count($array) - 1);
    }
}
