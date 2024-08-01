<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query;

use Vgrish\Yclients\Api\EntityState;
use Vgrish\Yclients\Api\ObjectRecord;
use Vgrish\Yclients\Api\Query\Endpoints\AbstractEndpoint;
use Vgrish\Yclients\Api\Query\Segments\AbstractCollectionSegment;
use Vgrish\Yclients\Services\Formatter;
use Vgrish\Yclients\YclientsApiMethodInvoker;

abstract class AbstractBuilder
{
    protected EntityState $state;
    protected array $path = [];
    protected bool $debug;
    protected array $body;

    public function __construct(
        protected null|array|ObjectRecord $record,
        protected array $params,
        bool $debug = false,
    ) {
        if (!$record instanceof ObjectRecord) {
            $this->record = new ObjectRecord($record ?? []);
        }

        $this->debug = $debug;
    }

    final public function state(): EntityState
    {
        return $this->state;
    }

    final public function record(): ObjectRecord
    {
        return $this->record;
    }

    final public function params(): array
    {
        return $this->params;
    }

    final public function paths(): array
    {
        return $this->path;
    }

    /**
     * @template T of AbstractEndpoint
     *
     * @param class-string<T> $builderClass
     */
    protected function resolveBuilder(string $builderClass): AbstractEndpoint
    {
        return new $builderClass($this->record, $this->params);
    }

    /**
     * @throws \ReflectionException
     */
    protected function invoke(string $class, string $method, array $body = []): static
    {
        $broker = new YclientsApiMethodInvoker($this, $class, $method, $body, $this->debug);
        $this->setState($broker->getState());

        return $this;
    }

    protected function setState(EntityState $state): void
    {
        $this->state = $state;

        if ($state->success()) {
            $data = Formatter::extractData($state->getData());
            // $meta = Formatter::extractData($state->getMeta());

            $pk = $this->paths();

            if (\is_a($this, AbstractCollectionSegment::class)) {
                $rows = [];

                foreach ($data as $row) {
                    $rows[] = (!empty($pk)) ? \array_merge($pk, $row) : $row;
                }

                $data = $rows;
            } else {
                $data = (!empty($pk)) ? \array_merge($pk, $data) : $data;
            }

            $this->record = new ObjectRecord($data);
        }
    }
}
