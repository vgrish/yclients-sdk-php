<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Endpoints;

use Vgrish\Yclients\Api\Query\Segments\User\UserAuthSegment;

final class UserEndpoint extends AbstractEndpoint
{
    /**
     * Входная точка для работы с Авторизацией.
     *
     * <code>
     * $auth = $yc->query()
     *  ->user()
     *  ->auth()
     *  ->create();
     * </code>
     *
     * @see \Vgrish\YclientsOpenApi\Api\AuthApi::authUser() create
     */
    public function auth(): UserAuthSegment
    {
        return $this->resolveBuilder(UserAuthSegment::class);
    }
}
