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

final class LoyaltyCardTypesSegment extends AbstractCollectionSegment
{
    /**
     * @return LoyaltyCardsByClientIdSegment
     *
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardTypeByCompanyIdGetList() get
     */
    public function byCompanyId(): LoyaltyCardTypesByCompanyIdSegment
    {
        return $this->resolveBuilder(LoyaltyCardTypesByCompanyIdSegment::class);
    }

    /**
     * @return LoyaltyCardsByClientPhoneSegment
     *
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardTypeByClientPhoneGetList() get
     */
    public function byClientPhone(): LoyaltyCardTypesByClientPhoneSegment
    {
        return $this->resolveBuilder(LoyaltyCardTypesByClientPhoneSegment::class);
    }

    /**
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardTypeByChainIdGetList() get
     */
    public function byChainId(): LoyaltyCardTypesByChainIdSegment
    {
        return $this->resolveBuilder(LoyaltyCardTypesByChainIdSegment::class);
    }
}
