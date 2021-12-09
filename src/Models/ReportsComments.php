<?php
declare(strict_types=1);

namespace Kanvas\Moderation\Models;

class ReportsComments extends BaseModel
{
    public int $reports_id;
    public int $users_id;
    public int $is_solution = 0;
    public ?string $comment = null;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('reports_comments');

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
            'reports_id',
            Reports::class,
            'id',
            [
                'alias' => 'reports'
            ]
        );
    }

    /**
     * Is this the correct solution.
     *
     * @return bool
     */
    public function isSolution() : bool
    {
        return (bool) $this->is_solution;
    }
}
