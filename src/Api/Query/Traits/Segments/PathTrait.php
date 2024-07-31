<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Traits\Segments;

use Vgrish\Yclients\Services\QueryParams;

trait PathTrait
{
    /**
     * метод для формирования параметров пути запроса.
     * Несколько параметров можно применить, вызвав метод несколько раз, или при помощи массива.
     *
     * <code>
     * $client = $yc->query()
     *  ->client()
     *  ->path('company_id', '204265')
     *  ->path('id', '233689471')
     *  или
     *  ->path(['company_id' => '204265', 'id' => '233689471'])
     *  или
     *  ->path([
     *      ['company_id', '204265'],
     *      ['id', '233689471'],
     *  ])
     *  ->get();
     * </code>
     */
    public function path(array|string $key, null|bool|float|int|string $value = null): static
    {
        $this->path = QueryParams::setParam($this->path, $key, $value);

        return $this;
    }
}
