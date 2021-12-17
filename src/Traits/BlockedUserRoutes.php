<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Traits;

use Baka\Contracts\Http\Api\CrudBehaviorTrait;
use Baka\Http\Exception\BadRequestException;
use Canvas\Contracts\Controllers\ProcessOutputMapperTrait;
use Canvas\Models\Users;
use Kanvas\Moderation\BlockUsers;
use Kanvas\Moderation\DTO\BlockedUser;
use Kanvas\Moderation\Mappers\BlockedUser as MappersBlockedUser;
use Kanvas\Moderation\Models\BlockedUsers as BlockedUsersModel;
use Phalcon\Http\Response;

trait BlockedUserRoutes
{
    use CrudBehaviorTrait, ProcessOutputMapperTrait{
        ProcessOutputMapperTrait::processOutput insteadof CrudBehaviorTrait;
    }

    /**
     * Init Controller.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new BlockedUsersModel();
        $this->dto = BlockedUser::class;
        $this->dtoMapper = new MappersBlockedUser();

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
        if ($this->userData->getId() == $userId) {
            throw new BadRequestException('You can not block yourself');
        }

        $user = Users::findFirstOrFail($userId);

        if (BlockUsers::isBlocked($this->userData, $user)) {
            $blockedUser = BlockUsers::unBlock($this->userData, $user);
        } else {
            $blockedUser = BlockUsers::block(
                $this->userData, 
                $user, 
                $this->app
            );
        }

        return $this->response(
            $this->processOutput($blockedUser)
        );
    }
}
