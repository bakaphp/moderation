<?php
declare(strict_types=1);

namespace Kanvas\Moderation\Models;

use Baka\Database\Model;

class BaseModel extends Model
{
    /**
     * Initialize method for model and specify local db connection.
     */
    public function initialize()
    {
        $this->setConnectionService('dbModeration');
    }
}
