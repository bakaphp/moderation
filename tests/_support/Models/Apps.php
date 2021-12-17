<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Tests\Support\Models;

use Canvas\Models\Apps as KanvasApps;

class Apps extends KanvasApps
{
    public function getId() : int
    {
        return 1;
    }
}
