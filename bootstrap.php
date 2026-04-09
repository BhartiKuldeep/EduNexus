<?php

declare(strict_types=1);

session_start();

define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');
define('VIEW_PATH', APP_PATH . '/Views');
define('STORAGE_PATH', BASE_PATH . '/storage');

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    if (! str_starts_with($class, $prefix)) {
        return;
    }
    $relative = substr($class, strlen($prefix));
    $file = APP_PATH . '/' . str_replace('\\', '/', $relative) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

require_once APP_PATH . '/helpers.php';

$config = require BASE_PATH . '/config/app.php';

use App\Core\Database;
use App\Core\Router;

Database::connect($config['database']);
$router = new Router();
require BASE_PATH . '/routes/web.php';
return $router;
