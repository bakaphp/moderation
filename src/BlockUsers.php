<?php

declare(strict_types=1);

namespace Kanvas\Moderation;

use Baka\Contracts\Auth\UserInterface;
use Canvas\Models\Apps;
use Kanvas\Moderation\Models\BlockedUsers;

class BlockUsers
{
    /**
     * Block an unblocked user
     *
     * @param UserInterface $user
     * @param UserInterface $blockedUser
     * @param Apps $app
     * @return BlockedUsers
     */
    public static function block(UserInterface $user, UserInterface $blocked, Apps $app) : BlockedUsers
    {
        $blockedUser = BlockedUsers::findFirst([
            'conditions' => 'users_id = :users_id: 
                            AND blocked_users_id = :blocked_users_id:
                            AND is_deleted = 0',
            'bind' => [
                'users_id' => $user->getId(),
                'blocked_users_id' => $blocked->getId()
            ]
        ]);

        if(!$blockedUser) {
            $blockedUser = new BlockedUsers();
            $blockedUser->users_id = $user->getId();
            $blockedUser->blocked_users_id = $blocked->getId();
            $blockedUser->apps_id = $app->getId();
            $blockedUser->saveOrFail();
        }

        return $blockedUser;
    }

    /**
     * Unblock an user if is blocked
     *
     * @param UserInterface $user
     * @param UserInterface $blockedUser
     * @return BlockedUsers
     */
    public static function unBlock(UserInterface $user, UserInterface $blockedUser) : BlockedUsers
    {
        $blockedUser = BlockedUsers::findFirst([
            'conditions' => 'users_id = :users_id: 
                            AND blocked_users_id = :blocked_users_id:
                            AND is_deleted = 0',
            'bind' => [
                'users_id' => $user->getId(),
                'blocked_users_id' => $blockedUser->getId()
            ]
        ]);

        if($blockedUser) {
            $blockedUser->softDelete();
        }

        return $blockedUser;
    }

    /**
     * Check if a user is Blocked
     *
     * @param UserInterface $user
     * @param UserInterface $blockedUser
     * @return boolean
     */
    public static function isBlocked(UserInterface $user, UserInterface $blockedUser) : bool
    {
        return (bool)BlockedUsers::count([
            'conditions' => 'users_id = :users_id: 
                            AND blocked_users_id = :blocked_users_id:
                            AND is_deleted = 0',
            'bind' => [
                'users_id' => $user->getId(),
                'blocked_users_id' => $blockedUser->getId()
            ]
        ]);
    }

}
