<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Endpoints;

use Vgrish\Yclients\Api\Query\Traits\Actions\EntityObjectsTrait;
use Vgrish\Yclients\Api\Query\Traits\Actions\GeneratorTrait;
use Vgrish\Yclients\Api\Query\Traits\Params\LimitOffsetTrait;
use Vgrish\Yclients\Api\Query\Traits\Params\ParamTrait;

abstract class AbstractCollectionEndpoint extends AbstractEndpoint
{
    use ParamTrait;
    use LimitOffsetTrait;
    use GeneratorTrait;
    use EntityObjectsTrait;
}
