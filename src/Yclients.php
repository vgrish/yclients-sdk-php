<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients;

use Vgrish\Yclients\Api\Query\QueryBuilder;

final class Yclients
{
    public const VERSION = '1.0.0';
    private static ?Yclients $instance = null;
    private ?string $partnerToken = null;
    private ?string $userToken = null;
    private int $limitRequestsPerSecond = 5;

    private function __construct()
    {
    }

    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setPartnerToken(string $value): self
    {
        $this->partnerToken = $value;

        return self::$instance;
    }

    public function setUserToken(string $value): self
    {
        $this->userToken = $value;

        return self::$instance;
    }

    public function setLimitRequest(int $value): self
    {
        $this->limitRequestsPerSecond = $value;

        return self::$instance;
    }

    public function getPartnerToken(): ?string
    {
        return $this->partnerToken;
    }

    public function getUserToken(): ?string
    {
        return $this->userToken;
    }

    public function getLimitRequest(): int
    {
        return $this->limitRequestsPerSecond;
    }

    /**
     * Конструктор запросов.
     *
     * <code>
     * $clients = $yc->query()
     *  ->clients()
     *  ->path('company_id', '204265')
     *  ->get();
     * </code>
     */
    public function query(): QueryBuilder
    {
        return new QueryBuilder();
    }
}
