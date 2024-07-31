<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api;

use Vgrish\Yclients\Services\Formatter;

final class EntityState
{
    /**
     * @param array<mixed, mixed> $meta
     */
    public function __construct(
        public readonly bool $success = false,
        public readonly mixed $data = null,
        public readonly mixed $meta = [],
    ) {
    }

    public function success(): bool
    {
        return $this->success;
    }

    public function getData(bool $prepare = false): mixed
    {
        return $prepare ? $this->prepare($this->data) : $this->data;
    }

    public function getMeta(bool $prepare = false): mixed
    {
        return $prepare ? $this->prepare($this->meta) : $this->meta;
    }

    private function prepare(mixed $value): mixed
    {
        return Formatter::extractData($value);
    }
}
