<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Tests\Integration;

use IntegrationTester;
use Kanvas\Moderation\Enums\Report;
use Kanvas\Moderation\Models\Reports;
use Kanvas\Moderation\Tests\Support\Controllers\ReportsController;

class ReportsRouteCest
{
    public function tetCreateReports(IntegrationTester $I) : void
    {
        $_POST = [
            'entity_namespace' => Reports::class,
            'entity_id' => rand(1, 100),
            'report_type_id' => Report::PENDING,
            'title' => 'Test Report',
            'description' => 'Test Description'
        ];

        $report = new ReportsController();
        $response = $report->create();
        $content = json_decode($report->create()->getContent(), true);

        $I->assertEquals(200, $response->getStatusCode());
        $I->assertEquals($_POST['entity_namespace'], $content['entity_namespace']);
    }
}
