<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Traits;

use Baka\Contracts\Http\Api\CrudBehaviorTrait;
use Canvas\Contracts\Controllers\ProcessOutputMapperTrait;
use Kanvas\Moderation\Models\ReportsTypes;
use Kanvas\Moderation\DTO\ReportsTypes as ReportsTypesDto;
use Kanvas\Moderation\Mappers\ReportsTypes as MappersReportsTypes;

trait ReportableTypesRoutes
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
        $this->model = new ReportsTypes();
        $this->dto = ReportsTypesDto::class;
        $this->dtoMapper = new MappersReportsTypes;

        $this->additionalSearchFields = [
            ['is_deleted', ':', 0],
            ['apps_id', ':', $this->app->getId()],
        ];
    }
}
