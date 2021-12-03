<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Traits;

use Baka\Contracts\Http\Api\CrudBehaviorTrait;
use Kanvas\Moderation\Models\ReportsTypes;

trait ReportableTypesRoutes
{
    use CrudBehaviorTrait;

    protected $createFields = [
        'entity_namespace',
        'entity_id',
        'report_type_id',
        'title',
        'description',
    ];

    /**
     * Init Controller.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new ReportsTypes();

        $this->additionalSearchFields = [
            ['is_deleted', ':', 0],
            ['apps_id', ':', $this->app->getId()],
        ];
    }
}
