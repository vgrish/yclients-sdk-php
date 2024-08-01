<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Endpoints;

use Vgrish\Yclients\Api\Query\Segments\Loyalty\LoyaltyCardSegment;
use Vgrish\Yclients\Api\Query\Segments\Loyalty\LoyaltyCardsSegment;
use Vgrish\Yclients\Api\Query\Segments\Loyalty\LoyaltyTransactionSegment;
use Vgrish\Yclients\Api\Query\Segments\Loyalty\LoyaltyTransactionsSegment;

final class LoyaltyEndpoint extends AbstractEndpoint
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
    public function transactions(): LoyaltyTransactionsSegment
    {
        return $this->resolveBuilder(LoyaltyTransactionsSegment::class);
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
    public function transaction(): LoyaltyTransactionSegment
    {
        return $this->resolveBuilder(LoyaltyTransactionSegment::class);
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
    public function card(): LoyaltyCardSegment
    {
        return $this->resolveBuilder(LoyaltyCardSegment::class);
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
    public function cards(): LoyaltyCardsSegment
    {
        return $this->resolveBuilder(LoyaltyCardsSegment::class);
    }
}
