<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Segments\Client;

use Vgrish\Yclients\Api\Query\Segments\AbstractEntitySegment;
use Vgrish\YclientsOpenApi\Api\ClientApi;

/**
 * @method \Vgrish\YclientsOpenApi\Model\ClientResponse object()
 */
class ClientSegment extends AbstractEntitySegment
{
    /**
     * @see \Vgrish\YclientsOpenApi\Api\ClientApi::clientGet() get
     */
    public function get(array $request = []): self
    {
        [$class, $method] = [ClientApi::class, 'clientGet'];
        $this->invoke($class, $method, $request);

        return $this;
    }

    /**
     * @param array $request {@see \Vgrish\YclientsOpenApi\Model\ClientCreateRequest::$openAPITypes}
     *
     * @see \Vgrish\YclientsOpenApi\Api\ClientApi::clientCreate() create
     */
    public function create(array $request = []): self
    {
        [$class, $method] = [ClientApi::class, 'clientCreate'];

        $this->invoke($class, $method, $request);

        return $this;
    }

    /**
     * @param array $request {@see \Vgrish\YclientsOpenApi\Model\ClientUpdateRequest::$openAPITypes}
     *
     * @see \Vgrish\YclientsOpenApi\Api\ClientApi::clientUpdate() update
     */
    public function update(array $request = []): self
    {
        [$class, $method] = [ClientApi::class, 'clientUpdate'];

        $this->invoke($class, $method, $request);

        return $this;
    }

    /**
     * @see \Vgrish\YclientsOpenApi\Api\ClientApi::clientRemove() remove
     */
    public function remove(array $request = []): self
    {
        [$class, $method] = [ClientApi::class, 'clientRemove'];

        $this->invoke($class, $method, $request);

        return $this;
    }
}
