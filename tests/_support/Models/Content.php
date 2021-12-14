<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Tests\Support\Models;

use Baka\Contracts\Database\ModelInterface;
use Kanvas\Content\Contracts\ReportableInterface;
use Kanvas\Moderation\Models\BaseModel;

class Content extends BaseModel implements ReportableInterface
{
    public function isOpen(): bool
    {
        return true;
    }

    public function isClosed(): bool
    {
        return false;
    }

    public function getEntityData(): ?ModelInterface
    {
        return new BaseModel;
    }
}
