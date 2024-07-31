<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Traits;

use Vgrish\Yclients\Api\Query\Endpoints\AbstractCollectionEndpoint;

trait ContentTrait
{
    public function row(?string $key = null): mixed
    {
        $array = $this->record()->toArray();

        if (\is_a($this, AbstractCollectionEndpoint::class)) {
            return $array;
        }

        if (!empty($key)) {
            return $array[$key] ?? null;
        }

        return $array;
    }
}
