<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Endpoints\User;

use Vgrish\Yclients\Api\Query\Endpoints\AbstractEntityEndpoint;
use Vgrish\YclientsOpenApi\Api\AuthApi;

/**
 * @method \Vgrish\YclientsOpenApi\Model\AuthResponse object()
 */
final class UserAuthEndpoint extends AbstractEntityEndpoint
{
    /**
     * @param array $request {@see \Vgrish\YclientsOpenApi\Model\AuthUserRequest::$openAPITypes}
     *
     * @see \Vgrish\YclientsOpenApi\Api\AuthApi::authUser() create
     */
    public function create(array $request = []): self
    {
        [$class, $method] = [AuthApi::class, 'authUser'];

        $this->invoke($class, $method, $request);

        return $this;
    }
}
