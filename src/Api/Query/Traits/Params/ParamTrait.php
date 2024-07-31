<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Traits\Params;

use Vgrish\Yclients\Services\QueryParams;

trait ParamTrait
{
    /**
     * метод для формирования параметров запроса.
     * Несколько параметров можно применить, вызвав метод несколько раз, или при помощи массива.
     *
     * <code>
     * $clients = $yc->query()
     *  ->clients()
     *  ->param('order_by', 'name')
     *  ->param('order_by_direction', 'desc')
     *  или
     *  ->param(['order_by' => 'name', 'order_by_direction' => 'desc'])
     *  или
     *  ->param([
     *      'fields' => [
     *          'id',
     *          'name',
     *          'phone,
     *          'email,
     *      ],
     * ])
     *  ->get();
     * </code>
     */
    public function param(array|string $key, null|array|bool|float|int|string $value = null): static
    {
        $this->params = QueryParams::setParam($this->params, $key, $value);

        return $this;
    }
}
