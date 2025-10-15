<?php
require_once __DIR__ . '/vendor/autoload.php';
// require_once __DIR__ . '/app/config.php';
// require_once __DIR__ . '/app/core/Controller.php';
// require_once __DIR__ . '/app/core/Model.php';
// require_once __DIR__ . '/app/core/Route.php';

// Load route definitions
require_once __DIR__ . '/app/routes/web.php';

// Điều hướng request
\App\core\Route::dispatch();
