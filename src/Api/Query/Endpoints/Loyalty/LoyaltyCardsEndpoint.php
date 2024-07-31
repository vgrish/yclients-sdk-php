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

final class LoyaltyCardsEndpoint extends AbstractCollectionEndpoint
{
    public function byClientId(): LoyaltyCardsByClientIdEndpoint
    {
        return $this->resolveBuilder(LoyaltyCardsByClientIdEndpoint::class);
    }

    public function byClientPhone(): LoyaltyCardsByClientPhoneEndpoint
    {
        return $this->resolveBuilder(LoyaltyCardsByClientPhoneEndpoint::class);
    }
}
