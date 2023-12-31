<?php

/** @var Bramus\Router\Router $router */

// Define routes here
$router->get('/test', App\Controllers\IndexController::class . '@test');
$router->get('/', App\Controllers\IndexController::class . '@test');

$router->post('/facility', App\Controllers\FacilityController::class. '@createNewFacility');
$router->get('/facility', App\Controllers\FacilityController::class. '@getOneFacility');
$router->put('/facility', App\Controllers\FacilityController::class . '@updateFacility');
$router->delete('/facility', App\Controllers\FacilityController::class . '@deleteFacility');

$router->get('/facilities', App\Controllers\FacilityController::class. '@getAll');
