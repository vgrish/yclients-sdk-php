<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Segments\Loyalty;

use Vgrish\Yclients\Api\Query\Segments\AbstractEntitySegment;
use Vgrish\YclientsOpenApi\Api\LoyaltyCardApi;

/**
 * @method \Vgrish\YclientsOpenApi\Model\LoyaltyCardResponse object()
 */
final class LoyaltyTransactionSegment extends AbstractEntitySegment
{
    /**
     * @param array $request {@see \Vgrish\YclientsOpenApi\Model\LoyaltyTransactionCreateRequest::$openAPITypes}
     *
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardTransactionCreate() create
     */
    public function create(array $request = []): self
    {
        [$class, $method] = [LoyaltyCardApi::class, 'loyaltyCardTransactionCreate'];

        $this->invoke($class, $method, $request);

        return $this;
    }
}
