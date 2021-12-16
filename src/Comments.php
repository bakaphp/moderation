<?php

declare(strict_types=1);

namespace Kanvas\Moderation;

use Baka\Contracts\Auth\UserInterface;
use Kanvas\Moderation\Models\Reports as ModelsReports;
use Kanvas\Moderation\Models\ReportsComments;
use Kanvas\Moderation\Enums\Report as ReportStatus;

class Comments
{
    /**
     * Create a new comment to a report
     *
     * @param ModelsReports $report
     * @param string $comment
     * @param UserInterface $user
     * @param boolean $is_solution
     * @return ReportsComments
     */
    public static function add(ModelsReports $report, string $comment, UserInterface $user, bool $isSolution = false) : ReportsComments
    {
        $newComment = new ReportsComments();
        $newComment->reports_id = $report->getId();
        $newComment->users_id = $user->getId();
        $newComment->comment = $comment;

        if($isSolution && $report->report_status_id !== ReportStatus::SOLVED) {
            $newComment->is_solution = (int) $isSolution;
            Reports::changeReportStatus($report);
            $report->solved_by = $newComment->users_id;
            $report->saveOrFail();
        }
        $newComment->saveOrFail();

        return $newComment;
    }

    /**
     * Remove comment to a report
     *
     * @param ReportsComments $comment
     * @return boolean
     */
    Public static function remove(ReportsComments $comment) : bool
    {
        $comment->softDelete();

        if($comment->is_solution) {
            $report = $comment->getReports();
            Reports::changeReportStatus($report, 'review');
        }

        return true;
    }
}
