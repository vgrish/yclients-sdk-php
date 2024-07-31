<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Endpoints\Client;

use Vgrish\Yclients\Api\Query\Endpoints\AbstractCollectionEndpoint;
use Vgrish\YclientsOpenApi\Api\ClientApi;

/**
 * @method array<\Vgrish\YclientsOpenApi\Model\ClientResponse> objects()
 */
class ClientsEndpoint extends AbstractCollectionEndpoint
{
    /**
     * @param array $request {@see \Vgrish\YclientsOpenApi\Model\ClientGetListRequest::$openAPITypes}
     *
     * @see \Vgrish\YclientsOpenApi\Api\ClientApi::clientGetList() get
     */
    public function get(array $request = []): self
    {
        // set defaults
        $request = \array_merge([
            'fields' => [
                'id',
                'name',
                'phone',
                'email',
            ],
        ], $request);
        [$class, $method] = [ClientApi::class, 'clientGetList'];
        $this->invoke($class, $method, $request);

        return $this;
    }
}
