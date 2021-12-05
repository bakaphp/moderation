<?php

/**
 * Setup autoloading.
 */
use function Baka\appPath;
use Dotenv\Dotenv;
use Phalcon\Loader;

if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', dirname(__DIR__) . '/');
}

//load classes
$loader = new Loader();
$loader->registerNamespaces([
    'Kanvas\Moderation' => appPath('src/'),
    'Kanvas\Moderation\Test' => appPath('tests/'),
    'Kanvas\Moderation\Test\Support' => appPath('tests/_support'),
    'Baka\Database' => appPath('vendor/baka/baka/src/database'),
]);

$loader->register();

require appPath('vendor/autoload.php');

$dotEnv = Dotenv::createImmutable(__DIR__ . '/../');
$dotEnv->load();
