<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Tests\Support\Models;

use Baka\Contracts\Auth\UserInterface;
use Kanvas\Moderation\Models\BaseModel;

class Users extends BaseModel implements UserInterface
{
    public function getId() : int
    {
        return 1;
    }
}
