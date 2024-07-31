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
use Vgrish\YclientsOpenApi\Api\LoyaltyTransactionApi;

/**
 * @method array<\Vgrish\YclientsOpenApi\Model\LoyaltyTransactionResponse> objects()
 */
final class LoyaltyTransactionsEndpoint extends AbstractCollectionEndpoint
{
    /**
     * @param array $request {@see \Vgrish\YclientsOpenApi\Api\LoyaltyTransactionApi::loyaltyTransactionGetList()}
     *
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyTransactionApi::loyaltyTransactionGetList() get
     */
    public function get(array $request = []): self
    {
        [$class, $method] = [LoyaltyTransactionApi::class, 'loyaltyTransactionGetList'];

        $this->invoke($class, $method, $request);

        return $this;
    }
}
