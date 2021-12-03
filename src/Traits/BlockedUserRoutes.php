<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Traits;

use Baka\Contracts\Http\Api\CrudBehaviorTrait;
use Canvas\Models\Users;
use Kanvas\Moderation\Models\BlockedUsers;
use Phalcon\Http\Response;

trait BlockedUserRoutes
{
    use CrudBehaviorTrait;

    /**
     * Init Controller.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new BlockedUsers();

        $this->additionalSearchFields = [
            ['is_deleted', ':', 0],
            ['apps_id', ':', $this->app->getId()],
            ['users_id', ':', $this->userData->getId()],
        ];
    }

    /**
     * Route to allow to block or unblock a user.
     *
     * @param int $userId
     *
     * @return Response
     */
    public function blockUser(int $userId) : Response
    {
        $user = Users::findFirstOrFail($userId);

        $blockedUser = BlockedUsers::findFirst([
            'conditions' => 'users_id = :users_id:
                            AND blocked_user_id = :blocked_user_id:
                            AND is_deleted = 0',
            'bind' => [
                'users_id' => $this->userData->getId(),
                'blocked_user_id' => $user->getId()
            ]
        ]);

        if ($blockedUser) {
            $blockedUser->softDelete();
        } else {
            $blockedUser = new BlockedUsers();
            $blockedUser->users_id = $this->userData->getId();
            $blockedUser->blocked_user_id = $user->getId();
            $blockedUser->apps_id = $this->app->getId();
            $blockedUser->saveOrFail();
        }

        return $this->response($blockedUser);
    }
}
