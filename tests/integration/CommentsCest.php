<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Tests\Integration;

use IntegrationTester;
use Kanvas\Moderation\Enums\Report;
use Kanvas\Moderation\Models\Reports;
use Kanvas\Moderation\Models\ReportsComments;
use Kanvas\Moderation\Models\ReportsTypes;
use Kanvas\Moderation\Services\Comments;
use Kanvas\Moderation\Tests\Support\Models\Content;
use Kanvas\Moderation\Tests\Support\Models\Users;

class CommentsCest
{
    public function testCreateComment(IntegrationTester $I) : void
    {
        $comment = "Comment for testing";

        $report = $this->generateReport();
        
        $response = Comments::add($report, $comment, new Users(), true);

        $I->assertEquals($comment, $response->comment);
    }

    public function removeComment(IntegrationTester $I) : void
    {
        $comment = ReportsComments::findFirst('is_deleted = 0');
        $response = Comments::remove($comment);

        $I->assertEquals(true, $response);
    }


    public function generateReport() : Reports
    {
        $report = new Reports();
        $report->apps_id = 1;
        $report->entity_namespace = Content::class;
        $report->entity_id = (string)rand(1, 100);
        $report->report_type_id = ReportsTypes::findFirst()->getId();
        $report->users_id = rand(1, 100);
        $report->report_status_id = Report::PENDING;
        $report->title = "Title Test";
        $report->saveOrFail();

        return $report;
    }
}
