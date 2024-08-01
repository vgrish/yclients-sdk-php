<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query;

use Vgrish\Yclients\Api\Query\Endpoints\ClientEndpoint;
use Vgrish\Yclients\Api\Query\Endpoints\ClientsEndpoint;
use Vgrish\Yclients\Api\Query\Endpoints\LoyaltyEndpoint;
use Vgrish\Yclients\Api\Query\Endpoints\UserEndpoint;

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
    public function user(): UserEndpoint
    {
        return $this->resolveBuilder(UserEndpoint::class);
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
    public function client(): ClientEndpoint
    {
        return $this->resolveBuilder(ClientEndpoint::class);
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
    public function clients(): ClientsEndpoint
    {
        return $this->resolveBuilder(ClientsEndpoint::class);
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
    public function loyalty(): LoyaltyEndpoint
    {
        return $this->resolveBuilder(LoyaltyEndpoint::class);
    }
}
