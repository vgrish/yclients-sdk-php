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

final class LoyaltyCardTypesEndpoint extends AbstractCollectionEndpoint
{
    /**
     * @return LoyaltyCardsByClientIdEndpoint
     *
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardTypeByCompanyIdGetList() get
     */
    public function byCompanyId(): LoyaltyCardTypesByCompanyIdEndpoint
    {
        return $this->resolveBuilder(LoyaltyCardTypesByCompanyIdEndpoint::class);
    }

    /**
     * @return LoyaltyCardsByClientPhoneEndpoint
     *
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardTypeByClientPhoneGetList() get
     */
    public function byClientPhone(): LoyaltyCardTypesByClientPhoneEndpoint
    {
        return $this->resolveBuilder(LoyaltyCardTypesByClientPhoneEndpoint::class);
    }

    /**
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardTypeByChainIdGetList() get
     */
    public function byChainId(): LoyaltyCardTypesByChainIdEndpoint
    {
        return $this->resolveBuilder(LoyaltyCardTypesByChainIdEndpoint::class);
    }
}
