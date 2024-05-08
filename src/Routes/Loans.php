<?php

use Slim\App;
use App\Controllers\LoansController;

return function (App $app) {
    $app->post('/loans', LoansController::class . ':create');
    $app->get('/loans/{id}', LoansController::class . ':getLoan');
    $app->put('/loans/{id}', LoansController::class . ':update');
    $app->delete('/loans/{id}', LoansController::class . ':delete');
    $app->get('/loans', LoansController::class . ':getLoans');
};
