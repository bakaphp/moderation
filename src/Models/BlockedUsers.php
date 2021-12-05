<?php
declare(strict_types=1);

namespace Kanvas\Moderation\Models;

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
}
