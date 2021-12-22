<?php

declare(strict_types=1);

namespace Kanvas\Moderation\DTO;

class ReportsTypes
{
    public int $id;
    public string $name;
    public ?string $description = null;
    public string $entity_namespace;
    public int $requires_description;
}
