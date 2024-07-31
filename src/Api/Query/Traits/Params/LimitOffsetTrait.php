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

trait LimitOffsetTrait
{
    public function pageSize(int $value): static
    {
        $this->params = QueryParams::setPageSize($this->params, $value);

        return $this;
    }

    public function count(int $value): static
    {
        $this->params = QueryParams::setCount($this->params, $value);

        return $this;
    }

    public function page(int $value): static
    {
        $this->params = QueryParams::setPage($this->params, $value);

        return $this;
    }
}
