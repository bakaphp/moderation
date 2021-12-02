<?php
declare(strict_types=1);

namespace Kanvas\Moderation\Models;

class ReportsPriorities extends BaseModel
{
    public float $weight = 0;
    public string $name;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('reports_priorities');
    }
}
