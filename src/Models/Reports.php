<?php
declare(strict_types=1);

namespace Kanvas\Moderation\Models;

use Baka\Contracts\Database\ModelInterface;
use Baka\Contracts\EventsManager\EventManagerAwareTrait;
use Canvas\Models\Users;

class Reports extends BaseModel
{
    use EventManagerAwareTrait;

    public int $apps_id;
    public string $entity_namespace;
    public string $entity_id;
    public int $report_type_id;
    public int $users_id;
    public int $report_status_id;
    public string $title;
    public ?string $description = null;
    public int $solved_by = 0;

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

        $this->belongsTo(
            'users_id',
            Users::class,
            'id',
            [
                'alias' => 'users',
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
     * Get comment that solve the report
     *
     * @return ReportsComments|null
     */
    public function getSolvedComment() : ?ReportsComments
    {
        return ReportsComments::findFirst([
            'conditions' => 'reports_id = :report_id: AND is_solution = :is_solution: AND is_deleted = 0',
            'bind' => [
                'report_id' => $this->getId(),
                'is_solution' => 1
            ]
        ]);
    }

    /**
     * Is this report solved?
     *
     * @return bool
     */
    public function isOpen() : bool
    {
        return $this->solved_by === 0;
    }

    /**
     * Is this report solved?
     *
     * @return bool
     */
    public function isClosed() : bool
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
