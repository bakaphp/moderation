<?php
declare(strict_types=1);

namespace Kanvas\Moderation\Models;

use Canvas\Models\AbstractModel;

class BaseModel extends AbstractModel
{
    /**
     * Initialize method for model and specify local db connection.
     */
    public function initialize()
    {
        $this->setConnectionService('dbModeration');
    }
}
