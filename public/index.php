<?php

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

// Загрузка переменных окружения
$dotenv = Dotenv::createImmutable(__DIR__, '.env'); 
$dotenv->load();

require __DIR__ . '/../src/Database/Database.php';

$app = AppFactory::create();

// Инициализация подключения к базе данных
App\Database\Database::getConnection();

// Middleware для обработки ошибок
\Sentry\init(['dsn' => 'https://examplePublicKey@o0.ingest.sentry.io/0' ]);

try {
    $this->functionFailsForSure();
} catch (\Throwable $exception) {
    \Sentry\captureException($exception);
}


// Инициализация маршрутов 
(require __DIR__ . '/../src/Routes/loans.php')($app);

$app->run();
