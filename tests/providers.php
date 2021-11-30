<?php

/**
 * Enabled providers. Order does matter.
 */

use Canvas\Providers\AppProvider;
use Canvas\Providers\CacheDataProvider;
use Canvas\Providers\DatabaseProvider as KanvasDatabaseProvider;
use Canvas\Providers\MapperProvider;
use Canvas\Providers\ModelsCacheProvider;
use Canvas\Providers\ModelsMetadataProvider;
use Canvas\Providers\RegistryProvider;
use Canvas\Providers\UserProvider;
use Canvas\Providers\ViewProvider;
use Kanvas\Workflow\Providers\DatabaseProvider as WorkflowDatabaseProvider;
use Kanvas\Workflow\Test\Support\Providers\ConfigProvider;
use Canvas\Providers\QueueProvider;

return [
    KanvasDatabaseProvider::class,
    ModelsMetadataProvider::class,
    RegistryProvider::class,
    AppProvider::class,
    UserProvider::class,
    WorkflowDatabaseProvider::class,
    CacheDataProvider::class,
    ModelsCacheProvider::class,
    MapperProvider::class,
    ViewProvider::class,
    ConfigProvider::class,
    QueueProvider::class
];
