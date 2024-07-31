<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query;

use Vgrish\Yclients\Api\Query\Segments\ClientSegment;
use Vgrish\Yclients\Api\Query\Segments\ClientsSegment;
use Vgrish\Yclients\Api\Query\Segments\LoyaltySegment;
use Vgrish\Yclients\Api\Query\Segments\UserSegment;

final class QueryBuilder extends AbstractBuilder
{
    public function __construct()
    {
        parent::__construct([], []);
    }

    /**
     * Входная точка для работы с Пользователем.
     *
     * <code>
     * $auth = $yc->query()
     * ->user()
     * ->auth()
     * ->param([
     *      'login'    => '7999999999',
     *      'password' => '123456',
     * ])
     *  ->create();
     * </code>
     */
    public function user(): UserSegment
    {
        return $this->resolveBuilder(UserSegment::class);
    }

    /**
     * Входная точка для работы с Клиентом.
     *
     * <code>
     * $client = $yc->query()
     * ->client()
     * ->get();
     * </code>
     */
    public function client(): ClientSegment
    {
        return $this->resolveBuilder(ClientSegment::class);
    }

    /**
     * Входная точка для работы с Клиентами.
     *
     * <code>
     * $clients = $yc->query()
     * ->clients()
     * ->get();
     * </code>
     */
    public function clients(): ClientsSegment
    {
        return $this->resolveBuilder(ClientsSegment::class);
    }

    /**
     * Входная точка для работы с Лояльностью.
     *
     * <code>
     * $transactions = $yc->query()
     * ->loyalty()
     * ->transactions()
     * ->get();
     * </code>
     */
    public function loyalty(): LoyaltySegment
    {
        return $this->resolveBuilder(LoyaltySegment::class);
    }
}
