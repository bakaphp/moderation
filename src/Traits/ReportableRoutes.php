<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Traits;

use Baka\Contracts\Http\Api\CrudBehaviorTrait;
use Kanvas\Moderation\Enums\Report;
use Kanvas\Moderation\Models\Reports;

trait ReportableRoutes
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
        $this->model = new Reports();

        $this->model->users_id = $this->userData->getId();
        $this->model->apps_id = $this->app->getId();
        $this->model->report_status_id = Report::PENDING;
    }

    /**
     * Given a array request from a method DTO transformed to whats is needed to
     * process it.
     *
     * @param array $request
     *
     * @return array
     */
    protected function processInput(array $request) : array
    {
        $this->request->validate([
            'entity_namespace' => 'required|string',
            'entity_id' => 'required',
            'report_type_id' => 'required|int',
            'title' => 'required|string',
            'description' => 'string',
        ]);

        return $request;
    }
}
