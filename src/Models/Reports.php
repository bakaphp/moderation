<?php
declare(strict_types=1);

namespace Kanvas\Moderation\Models;

use Baka\Contracts\Database\ModelInterface;
use Baka\Contracts\EventsManager\EventManagerAwareTrait;

class Reports extends BaseModel
{
    use EventManagerAwareTrait;

    public int $apps_id;
    public string $entity_namespace;
    public string $entity_id;
    public int $report_type_id;
    public int $user_id;
    public int $report_status_id;
    public string $title;
    public ?string $description = null;
    public int $solved_by;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('reports');

        $this->belongsTo(
            'solved_by',
            Users::class,
            'id',
            [
                'alias' => 'solvedUser',
                'reusable' => true
            ]
        );

        $this->belongsTo(
            'report_type_id',
            ReportsTypes::class,
            'id',
            [
                'alias' => 'type',
                'reusable' => true
            ]
        );

        $this->belongsTo(
            'report_status_id',
            ReportsStatus::class,
            'id',
            [
                'alias' => 'status',
                'reusable' => true
            ]
        );
    }

    /**
     * Get entity by its relationship.
     *
     * @return ModelInterface|null
     */
    public function getEntityData() : ?ModelInterface
    {
        if ($this->entity_namespace && class_exists($this->entity_namespace)) {
            return $this->entity_namespace::findFirst($this->entity_id);
        }

        return null;
    }

    /**
     * Is this report solved?
     *
     * @return bool
     */
    public function isSolved() : bool
    {
        return $this->solved_by > 0;
    }

    /**
     * Event after create.
     *
     * @return void
     */
    public function afterCreate()
    {
        $this->fire('moderation:createReport', $this);
    }
}
