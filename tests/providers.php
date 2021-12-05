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
use Canvas\Providers\QueueProvider;
use Canvas\Providers\RegistryProvider;
use Canvas\Providers\RequestProvider;
use Canvas\Providers\ResponseProvider;
use Canvas\Providers\UserProvider;
use Canvas\Providers\ViewProvider;
use Kanvas\Moderation\Providers\DatabaseProvider as ModerationDatabaseProvider;
use Kanvas\Moderation\Test\Support\Providers\ConfigProvider;

return [
    KanvasDatabaseProvider::class,
    ModelsMetadataProvider::class,
    RegistryProvider::class,
    AppProvider::class,
    UserProvider::class,
    ModerationDatabaseProvider::class,
    RequestProvider::class,
    ResponseProvider::class,
    CacheDataProvider::class,
    ModelsCacheProvider::class,
    MapperProvider::class,
    ViewProvider::class,
    ConfigProvider::class,
    QueueProvider::class
];
