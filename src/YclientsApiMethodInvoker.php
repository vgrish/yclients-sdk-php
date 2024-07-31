<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients;

use Vgrish\Yclients\Api\EntityState;
use Vgrish\Yclients\Api\Query\AbstractBuilder;
use Vgrish\Yclients\Services\Header;
use Vgrish\Yclients\Services\RateLimiter;
use Vgrish\YclientsOpenApi\Api\DefaultApi;
use Vgrish\YclientsOpenApi\ApiException;
use Vgrish\YclientsOpenApi\Model\BaseResponse;

final class YclientsApiMethodInvoker
{
    private static ?Yclients $yclients = null;
    private \ReflectionMethod $reflection;
    private EntityState $state;
    private array $arguments = [];

    /**
     * @var array<string, array<string, string>>
     */
    private static array $specs = [];

    /**
     * @param mixed $body
     *
     * @throws \ReflectionException
     */
    public function __construct(
        protected AbstractBuilder $builder,
        protected string $class,
        protected string $method,
        protected array $body = [],
        protected bool $debug = false,
    ) {
        if (null === self::$yclients) {
            self::$yclients = Yclients::getInstance();
        }

        $this->reflection = new \ReflectionMethod($class, $method);
        $this->arguments = $this->getArguments();

        if ($this->debug) {
            $this->state = $this->debug();
        } else {
            $this->state = $this->execute();
        }
    }

    public function getState(): EntityState
    {
        return $this->state;
    }

    public function getBody(): mixed
    {
        return $this->body;
    }

    private function execute(): EntityState
    {
        RateLimiter::getInstance(self::$yclients->getLimitRequest());
        RateLimiter::check();

        try {
            /** @var DefaultApi $apiClient */
            $apiClient = new $this->class();

            /** @var BaseResponse $result */
            $result = $this->reflection->invoke($apiClient, ...$this->arguments);

            /** @phpstan-ignore start */
            $state = new EntityState(
                success: $result->getSuccess(),
                data: $result->getData(),
                meta: $result->getMeta(),
            );
            // @phpstan-ignore end
        } catch (ApiException $e) {
            $response = \json_decode($e->getResponseBody(), true);
            $state = new EntityState(
                success: false,
                data: $response['data'] ?? null,
                meta: $response['meta'] ?? [],
            );
        }

        return $state;
    }

    private function debug(): EntityState
    {
        return new EntityState(
            success: false,
            data: $this,
        );
    }

    private function getArguments(): array
    {
        $args = [];

        $builderPaths = $this->builder->paths();
        $builderParams = $this->builder->params();
        $builderRecord = $this->builder->record();

        $values = \array_merge(
            \array_filter($this->getBody(), static fn ($value) => null !== $value && '' !== $value),
            \array_filter($builderRecord->toArray(), static fn ($value) => null !== $value && '' !== $value),
            \array_filter($builderParams, static fn ($value) => null !== $value && '' !== $value),
            \array_filter($builderPaths, static fn ($value) => null !== $value && '' !== $value),
        );

        $requireRequestFields = $this->getRequireRequestFields();

        foreach ($this->reflection->getParameters() as $parameter) {
            $value = null;

            if ($parameter->isOptional()) {
                $value = $parameter->getDefaultValue();
            }

            $name = $parameter->getName();
            $spec = $this->getSpec($name);
            $getter = $this->convertParameterNameToGetterName($name);

            if (\method_exists($this, $getter)) {
                $value = $this->{$getter}($spec);
            } elseif (\method_exists($this->builder, $getter)) {
                $value = $this->builder->{$getter}($spec);
            } elseif (\str_ends_with($getter, 'RequestValue')) {
                $value = \array_merge($builderParams, $this->getBody());

                if ($requireRequestFields) {
                    foreach ($requireRequestFields as $requireRequestField) {
                        if (!\array_key_exists(
                            $requireRequestField,
                            $value,
                        ) && $requestFieldValue = $builderRecord->{$requireRequestField} ?? null) {
                            $value[$requireRequestField] = $requestFieldValue;
                        }
                    }
                }
            } elseif (\array_key_exists($name, $values)) {
                $value = $values[$name] ?? null;
            }

            if (null !== $value) {
                $args[$name] = $value;
            }
        }

        if ($this->reflection->getNumberOfRequiredParameters() > \count($args)) {
            throw new \Exception("Too few arguments to call {$this->class} {$this->method}");
        }

        return $args;
    }

    /**
     * @return array<int, string>
     */
    private function getRequireRequestFields(): array
    {
        $required = [];
        $modelRequestClass = \sprintf('Vgrish\YclientsOpenApi\Model\%sRequest', \ucfirst($this->method));

        if (\class_exists($modelRequestClass)) {
            $instance = new $modelRequestClass();

            if (\method_exists($instance, 'listInvalidProperties')) {
                $list = $instance->listInvalidProperties();

                foreach ($list as $item) {
                    \preg_match("/'([^']+)'/", $item, $matches);

                    if (isset($matches[1])) {
                        $required[] = \trim($matches[1]);
                    }
                }
            }
        }

        return $required;
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function getSpecs(): array
    {
        $key = \serialize([$this->class, $this->method]);

        if (!isset(self::$specs[$key])) {
            $specs = [];
            \preg_match_all(
                '/@param\s+(\S+)\s+\$(\S+)\s+(.+)/',
                (string) $this->reflection->getDocComment(),
                $matches,
                \PREG_SET_ORDER,
            );

            foreach ($matches as $match) {
                $specs[$match[2]] = [
                    'key' => $match[2],
                    'type' => $match[1],
                    'desc' => $match[3],
                    'content' => $match[0],
                ];
            }

            self::$specs[$key] = $specs;
        }

        return self::$specs[$key];
    }

    /**
     * @return null|list<string>
     */
    private function getSpec(string $key): ?array
    {
        $specs = $this->getSpecs();

        return $specs[$key] ?? null;
    }

    private function convertParameterNameToGetterName(
        string $input,
        string $prefix = 'get',
        string $suffix = 'Value',
    ): string {
        $parts = \explode('_', $input);
        $parts = \array_map(static function ($part) {
            return \ucfirst(\mb_strtolower($part));
        }, $parts, \array_keys($parts));

        return $prefix . \implode('', $parts) . $suffix;
    }

    private function getAcceptValue(): string
    {
        return Header::get('accept');
    }

    private function getContentTypeValue(): string
    {
        return Header::get('content_type');
    }

    private function getAuthorizationValue(mixed $attr): string
    {
        return Header::getAuthorization(self::$yclients, $attr);
    }
}
