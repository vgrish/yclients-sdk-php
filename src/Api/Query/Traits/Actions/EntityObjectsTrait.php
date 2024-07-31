<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Traits\Actions;

trait EntityObjectsTrait
{
    public function objects(): array
    {
        $objects = $this->state()->getData();

        return \is_iterable($objects) ? $objects : [];
    }
}
