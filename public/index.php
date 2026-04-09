<?php

declare(strict_types=1);

$router = require dirname(__DIR__) . '/bootstrap.php';
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
