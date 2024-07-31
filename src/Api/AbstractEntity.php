<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api;

abstract class AbstractEntity extends \stdClass implements EntityInterface
{
    /**
     * @var array<string, mixed>
     */
    protected array $contentContainer = [];

    public function __construct(mixed $content = [])
    {
        $this->hydrate($content ?? []);
    }

    public function __get(string $name)
    {
        return $this->contentContainer[$name] ?? null;
    }

    public function __set(string $name, mixed $value): void
    {
        $this->contentContainer[$name] = $value;
    }

    public function __isset(string $name)
    {
        return \array_key_exists($name, $this->contentContainer);
    }

    public function __unset(string $name): void
    {
        unset($this->contentContainer[$name]);
    }

    final public function getContent(): array
    {
        return $this->contentContainer;
    }

    final public function getRows(): array
    {
        return $this->getContent()['rows'] ?? [];
    }

    final public function toArray(): array
    {
        return $this->getContent();
    }

    final public function toString(): string
    {
        return \json_encode($this->getContent(), \JSON_THROW_ON_ERROR);
    }

    final public function toStdClass(): \stdClass
    {
        return \json_decode($this->toString());
    }

    protected function hydrate(array $content): void
    {
        $this->contentContainer = [];

        $this->hydrateAdd($content);
    }

    protected function hydrateAdd(array $content): void
    {
        foreach ($content as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
