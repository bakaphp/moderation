<?php

declare(strict_types=1);

namespace Kanvas\Moderation\DTO;

class BlockedUser
{
    public int $id;
    public string $display_name;
    public int $is_blocked = 1;
    public string $firstname;
    public string $lastname;
    public ?object $photo = null;
    public string $created_at;
}
