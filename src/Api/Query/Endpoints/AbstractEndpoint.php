<?php

declare(strict_types=1);

/**
 * Copyright (c) 2024 Vgrish <vgrish@gmail.com>
 * yclients-sdk-php package for YCLIENTS
 * The version 1.0.0
 * @see https://github.com/vgrish/yclients-sdk-php
 */

namespace Vgrish\Yclients\Api\Query\Endpoints;

use Vgrish\Yclients\Api\Query\AbstractBuilder;
use Vgrish\Yclients\Api\Query\Traits\CallBackTrait;
use Vgrish\Yclients\Api\Query\Traits\ContentTrait;
use Vgrish\Yclients\Api\Query\Traits\DebugTrait;
use Vgrish\Yclients\Api\Query\Traits\Params\ParamTrait;
use Vgrish\Yclients\Api\Query\Traits\Segments\PathTrait;

abstract class AbstractEndpoint extends AbstractBuilder
{
    use DebugTrait;
    use CallBackTrait;
    use ContentTrait;
    use PathTrait;
    use ParamTrait;
}
