<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Services;

use Kanvas\Moderation\Enums\Report as ReportStatus;
use Kanvas\Moderation\Models\Reports as ModelsReports;
use Kanvas\Content\Contracts\ReportableInterface;
use Phalcon\Mvc\Model\ResultsetInterface;

class Reports
{
    /**
     * Return a result set of reports from an Entity
     *
     * @param ReportableInterface $entity
     * @param string $status
     * @return ResultsetInterface
     */
    public static function getReportsByEntity(ReportableInterface $entity, string $status = 'pending') : ResultsetInterface
    {
        $status = self::getReportStatusByName($status);

        return ModelsReports::find([
            'conditions' => 'entity_namespace = :namespace: AND report_status_id = :status_id: AND is_deleted = 0',
            'bind' => [
                'namespace' => get_class($entity),
                'status_id' => $status
            ]
        ]);
    }


    /**
     * Get Report type Status id by name
     *
     * @param string $status
     * @return integer
     */
    public static function getReportStatusByName(string $status) : int
    {
        switch ($status) {
            case 'solved':
                return ReportStatus::SOLVED;
                break;
            case 'review':
                return ReportStatus::REVIEW;
                break;
            case 'pending':
                return ReportStatus::PENDING;
                break;
        }
    }
}
