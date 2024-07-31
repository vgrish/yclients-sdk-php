<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Segments;

use Vgrish\Yclients\Api\Query\Endpoints\Loyalty\LoyaltyCardEndpoint;
use Vgrish\Yclients\Api\Query\Endpoints\Loyalty\LoyaltyCardsEndpoint;
use Vgrish\Yclients\Api\Query\Endpoints\Loyalty\LoyaltyTransactionEndpoint;
use Vgrish\Yclients\Api\Query\Endpoints\Loyalty\LoyaltyTransactionsEndpoint;

final class LoyaltySegment extends AbstractSegment
{
    /**
     * Входная точка для работы с Транзакциями Лояльности.
     *
     * <code>
     * $transactions = $yc->query()
     *  ->loyalty()
     *  ->transactions()
     *  ->get();
     * </code>
     *
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyTransactionApi::loyaltyTransactionGetList() get
     */
    public function transactions(): LoyaltyTransactionsEndpoint
    {
        return $this->resolveBuilder(LoyaltyTransactionsEndpoint::class);
    }

    /**
     * Входная точка для работы с Транзакцией Лояльности.
     *
     * <code>
     * $transaction = $yc->query()
     *  ->loyalty()
     *  ->transaction()
     *  ->create();
     * </code>
     *
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardTransactionCreate() create
     */
    public function transaction(): LoyaltyTransactionEndpoint
    {
        return $this->resolveBuilder(LoyaltyTransactionEndpoint::class);
    }

    /**
     * Входная точка для работы с Картой Лояльности.
     *
     * <code>
     * $transactions = $yc->query()
     *  ->loyalty()
     *  ->card()
     *  ->create();
     * </code>
     *
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardCreate() create
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardRemove() remove
     */
    public function card(): LoyaltyCardEndpoint
    {
        return $this->resolveBuilder(LoyaltyCardEndpoint::class);
    }

    /**
     * Входная точка для работы с Картами Лояльности.
     *
     * <code>
     * $transactions = $yc->query()
     *  ->loyalty()
     *  ->cards()
     *  ->create();
     * </code>
     *
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardCreate() create
     * @see \Vgrish\YclientsOpenApi\Api\LoyaltyCardApi::loyaltyCardRemove() remove
     */
    public function cards(): LoyaltyCardsEndpoint
    {
        return $this->resolveBuilder(LoyaltyCardsEndpoint::class);
    }
}
