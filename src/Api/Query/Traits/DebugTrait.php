<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Traits;

trait DebugTrait
{
    public function debug(bool $value = true): self
    {
        $instance = new static($this->record, $this->params, $value);
        $instance->path($this->paths());

        return $instance;
    }
}
