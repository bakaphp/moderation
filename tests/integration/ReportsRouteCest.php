<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Tests\Integration;

use IntegrationTester;
use Kanvas\Moderation\Enums\Report;
use Kanvas\Moderation\Models\Reports;
use Kanvas\Moderation\Models\ReportsStatus;
use Kanvas\Moderation\Services\Reports as ServicesReports;
use Kanvas\Moderation\Tests\Support\Controllers\ReportsController;
use Kanvas\Moderation\Tests\Support\Controllers\ReportTypesController;
use Kanvas\Moderation\Tests\Support\Models\Content;

class ReportsRouteCest
{
    public function testCreateReports(IntegrationTester $I) : void
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

    public function testListReportTypes(IntegrationTester $I) : void
    {
        $report = new ReportTypesController();
        $response = $report->index();
        $content = json_decode($response->getContent(), true);

        $I->assertEquals(200, $response->getStatusCode());
        $I->assertEquals(Report::PENDING, $content[0]['id']);
    }

    public function testGetReportsByEntity(IntegrationTester $I) : void
    {
        $content = $this->generateReport();

        $results = ServicesReports::getReportsByEntity(new Content);

        $I->assertEquals($results->toArray()[0]['entity_namespace'],$content['entity_namespace']);
    }

    public function testChangeReportStatus(IntegrationTester $I) : void
    {
        $this->generateReport();

        $report = Reports::findFirst();

        $result = ServicesReports::changeReportStatus($report, 'solved');
        $I->assertEquals(Report::SOLVED, $result->report_status_id);

        $result = ServicesReports::changeReportStatus($report, 'review');
        $I->assertEquals(Report::REVIEW, $result->report_status_id);

        $result = ServicesReports::changeReportStatus($report, 'pending');
        $I->assertEquals(Report::PENDING, $result->report_status_id);
    }

    public function generateReport() : array
    {
        $_POST = [
            'entity_namespace' => Content::class,
            'entity_id' => rand(1, 100),
            'report_type_id' => Report::PENDING,
            'title' => 'Test Report '. rand(1, 100),
            'description' => 'Test Description '.rand(1, 100)
        ];

        $report = new ReportsController();
        $report->create();
        
        return json_decode($report->create()->getContent(), true);
    }
}
