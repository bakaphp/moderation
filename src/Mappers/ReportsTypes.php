<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Mappers;

use AutoMapperPlus\CustomMapper\CustomMapper;

class ReportsTypes extends CustomMapper
{

    /**
     * Undocumented function.
     *
     * @param ReportsTypes $reportTypeDto
     * @param ReportsTypes $reportType
     * @param array $context
     *
     * @return void
     */
    public function mapToObject($reportType, $reportTypeDto, array $context = [])
    {
        $reportTypeDto->id = $reportType->getId();
        $reportTypeDto->name = $reportType->name;
        $reportTypeDto->description = $reportType->description;
        $reportTypeDto->entity_namespace = $reportType->entity_namespace;
        $reportTypeDto->requires_description = $reportType->requires_description;

        return $reportTypeDto;
    }
}
