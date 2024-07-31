<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Endpoints\Loyalty;

use Vgrish\Yclients\Api\Query\Endpoints\AbstractCollectionEndpoint;
use Vgrish\YclientsOpenApi\Api\LoyaltyCardApi;

/**
 * @method array<\Vgrish\YclientsOpenApi\Model\LoyaltyCardTypeResponse> objects()
 */
final class LoyaltyCardTypesByCompanyIdEndpoint extends AbstractCollectionEndpoint
{
    /**
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardTypeByCompanyIdGetList() get
     */
    public function get(array $request = []): self
    {
        [$class, $method] = [LoyaltyCardApi::class, 'loyaltyCardTypeByCompanyIdGetList'];

        $this->invoke($class, $method, $request);

        return $this;
    }
}
