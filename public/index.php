<?php

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

// Загрузка переменных окружения
$dotenv = Dotenv::createImmutable(__DIR__, '.env');
$dotenv->load();

// Инициализация Sentry
\Sentry\init([
    'dsn' => 'https://10e151fa226759dadd36eda729fd557d@o4507217079304192.ingest.de.sentry.io/4507217452073040',
    // Specify a fixed sample rate
    'traces_sample_rate' => 1.0,
  ]);

// Глобальный обработчик исключений
set_exception_handler(function ($e) {
    \Sentry\captureException($e);
    http_response_code(500);
    echo 'Произошла ошибка, администратор уведомлен.';
    exit;
});

require __DIR__ . '/../src/Database/Database.php';

$app = AppFactory::create();

// Инициализация подключения к базе данных
App\Database\Database::getConnection();

// Middleware для обработки ошибок
$app->addErrorMiddleware(true, true, true);

// Middleware для обработки JSON формата
$app->add(function ($request, $handler) {
    if ($request->getHeaderLine('Content-Type') === 'application/json') {
        $contents = json_decode(file_get_contents('php://input'), true);
        $request = $request->withParsedBody($contents);
    }
    return $handler->handle($request);
});

// Инициализация маршрутов
(require __DIR__ . '/../src/Routes/loans.php')($app);

$app->run();
