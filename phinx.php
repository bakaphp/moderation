<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'paths' => [
        'migrations' => [
            getenv('PHINX_CONFIG_DIR') . '/storage/db/migrations',
        ],
        'seeds' => [
            getenv('PHINX_CONFIG_DIR') . '/storage/db/seeds',
        ],
    ],
    'environments' => [
        'default_migration_table' => 'ut_migrations',
        'default_database' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => getenv('MODERATION_MYSQL_HOST'),
            'name' => getenv('MODERATION_MYSQL_NAME'),
            'user' => getenv('MODERATION_MYSQL_USER'),
            'pass' => getenv('MODERATION_MYSQL_PASS'),
            'port' => 3306,
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => getenv('MODERATION_MYSQL_HOST'),
            'name' => getenv('MODERATION_MYSQL_NAME'),
            'user' => getenv('MODERATION_MYSQL_USER'),
            'pass' => getenv('MODERATION_MYSQL_PASS'),
            'port' => 3306,
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation',
];
