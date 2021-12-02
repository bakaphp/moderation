<?php
declare(strict_types=1);

namespace Kanvas\Moderation\Models;

class ReportsStatus extends BaseModel
{
    public int $apps_id;
    public string $name;
    public ?string $description = null;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('reports_status');
    }
}
