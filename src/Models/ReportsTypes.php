<?php
declare(strict_types=1);

namespace Kanvas\Moderation\Models;

class ReportsTypes extends BaseModel
{
    public int $apps_id;
    public int $priorities_id;
    public int $can_send_email_notification = 0;
    public string $entity_namespace;
    public string $name;
    public ?string $description = null;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('reports_types');

        $this->belongsTo(
            'priorities_id',
            ReportsPriorities::class,
            'id',
            [
                'alias' => 'priority',
            ]
        );
    }

    /**
     * Can this report status send user notification.
     *
     * @return bool
     */
    public function canSendNotification()
    {
        return (bool) $this->can_send_email_notification;
    }
}
