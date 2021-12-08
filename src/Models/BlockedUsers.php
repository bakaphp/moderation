<?php
declare(strict_types=1);

namespace Kanvas\Moderation\Models;

use Baka\Contracts\Auth\UserInterface;
use Baka\Contracts\EventsManager\EventManagerAwareTrait;
use Canvas\Models\Users;

class BlockedUsers extends BaseModel
{
    use EventManagerAwareTrait;

    public int $users_id;
    public int $blocked_users_id;
    public int $apps_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('blocked_users');

        $this->belongsTo(
            'users_id',
            Users::class,
            'id',
            [
                'alias' => 'user',
                'reusable' => true
            ]
        );

        $this->belongsTo(
            'blocked_users_id',
            Users::class,
            'id',
            [
                'alias' => 'blockedUser',
                'reusable' => true
            ]
        );
    }

    /**
     * Event after create.
     *
     * @return void
     */
    public function afterCreate()
    {
        $this->fire('moderation:blockedUser', $this);
    }


    /**
     * Verify if the user blocked the verify user.
     *
     * @param UserInterface $user
     * @param UserInterface $verifyUser
     *
     * @return bool
     */
    public static function isBlocked(UserInterface $user, UserInterface $verifyUser) : bool
    {
        if ($user->getId() === $verifyUser->getId()) {
            return false;
        }

        return (bool) self::count([
            'conditions' => 'users_id = :users_id: 
                            AND blocked_users_id = :blocked_users_id: 
                            AND is_deleted = 0',
            'bind' => [
                'users_id' => $user->getId(),
                'blocked_users_id' => $verifyUser->getId()
            ]
        ]);
    }
}
