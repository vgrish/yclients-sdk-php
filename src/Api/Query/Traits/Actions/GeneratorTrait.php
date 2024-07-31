<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Traits\Actions;

trait GeneratorTrait
{
    /**
     * Создать генератор из запроса итерируемой сущности.
     * Генератор можно перебирать в цикле, при этом подгружать новые страницы он будет самостоятельно.
     *
     * <code>
     * $generator = $yc->query()->clients()
     * ->path('company_id', '204265')
     * ->pageSize(100)
     * ->generator(function ($builder) {
     *      return $builder->get();
     * });
     * foreach ($generator as $client) {
     *      ...
     * }
     * </code>
     */
    public function generator(\Closure $callback, bool $returnArray = false, string $pageKey = 'page'): \Generator
    {
        while (true) {
            if (!$callback($this) || !$this->state()->success()) {
                break;
            }

            if (!$returnArray) {
                $rows = $this->objects();
            } else {
                $rows = $this->row();
            }

            if (empty($rows)) {
                break;
            }

            foreach ($rows as $row) {
                yield $row;
            }

            $params = $this->params();
            $pageValue = \max((int) ($params[$pageKey] ?? 0), 1);

            $this->param($pageKey, ++$pageValue);
        }
    }
}
