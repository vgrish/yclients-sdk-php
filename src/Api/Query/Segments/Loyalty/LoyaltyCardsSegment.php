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

final class LoyaltyCardsSegment extends AbstractCollectionSegment
{
    public function byClientId(): LoyaltyCardsByClientIdSegment
    {
        return $this->resolveBuilder(LoyaltyCardsByClientIdSegment::class);
    }

    public function byClientPhone(): LoyaltyCardsByClientPhoneSegment
    {
        return $this->resolveBuilder(LoyaltyCardsByClientPhoneSegment::class);
    }
}
