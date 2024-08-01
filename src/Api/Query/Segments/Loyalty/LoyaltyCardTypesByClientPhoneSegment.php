<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Segments\Loyalty;

use Vgrish\Yclients\Api\Query\Segments\AbstractCollectionSegment;
use Vgrish\YclientsOpenApi\Api\LoyaltyCardApi;

/**
 * @method array<\Vgrish\YclientsOpenApi\Model\LoyaltyCardTypeResponse> objects()
 */
final class LoyaltyCardTypesByClientPhoneSegment extends AbstractCollectionSegment
{
    /**
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardTypeByClientPhoneGetList() get
     */
    public function get(array $request = []): self
    {
        [$class, $method] = [LoyaltyCardApi::class, 'loyaltyCardTypeByClientPhoneGetList'];

        $this->invoke($class, $method, $request);

        return $this;
    }
}
