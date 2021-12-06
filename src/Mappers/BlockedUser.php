<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Mappers;

use AutoMapperPlus\CustomMapper\CustomMapper;

class BlockedUser extends CustomMapper
{

    /**
     * Undocumented function.
     *
     * @param Users $user
     * @param Profile $profile
     * @param array $context
     *
     * @return void
     */
    public function mapToObject($blocked, $blockedUser, array $context = [])
    {
        $blockedUser->id = $blocked->blockedUser->getId();
        $blockedUser->displayname = $blocked->blockedUser->displayname;
        $blockedUser->firstname = $blocked->blockedUser->firstname;
        $blockedUser->lastname = $blocked->blockedUser->lastname;
        $blockedUser->photo = $blocked->blockedUser->getPhoto();
        $blockedUser->is_blocked = (int) !$blocked->is_deleted;
        $blockedUser->created_at = $blocked->created_at;

        return $blockedUser;
    }
}
