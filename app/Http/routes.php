<?php

use App\Http\Controllers\ReportsApiController as Reports;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$app->get('/api/reports/clearCache', function () use ($app) {
    return Reports::clearCache();
});

$app->get('/api/reports/speciesByMonth', function () use ($app) {
    return Reports::speciesByMonth();
});

$app->get('/api/reports/speciesByYear', function () use ($app) {
    return Reports::speciesByYear();
});

$app->get('/api/reports/speciesForMonth/{monthNumber}', function ($monthNumber) use ($app) {
    return Reports::speciesForMonth($monthNumber);
});

$app->get('/api/reports/speciesByOrder', function () use ($app) {
    return Reports::speciesByOrder();
});

$app->get('/api/reports/speciesForOrder/{orderId}', function ($orderId) use ($app) {
    return Reports::speciesForOrder($orderId);
});

$app->get('/api/reports/speciesByLocation', function () use ($app) {
    return Reports::speciesByLocation();
});

$app->get('/api/reports/speciesByCounty', function () use ($app) {
    return Reports::speciesByCounty();
});

$app->get('/api/reports/speciesAll', function () use ($app) {
    return Reports::speciesAll();
});

$app->get('/api/reports/listOrders', function () use ($app) {
    return Reports::listOrders();
});

$app->get('/api/reports/listOrdersAll', function () use ($app) {
    return Reports::listOrdersAll();
});

$app->get('/api/reports/searchAll/{searchString}/{orderId}', function ($searchString, $orderId) use ($app) {
    return Reports::searchAll($searchString, $orderId);
});

$app->get('/api/reports/speciesDetail/{speciesId}', function ($speciesId) use ($app) {
    return Reports::speciesDetail($speciesId);
});

$app->get('/api/reports/monthsForSpecies/{speciesId}', function ($speciesId) use ($app) {
    return Reports::monthsForSpecies($speciesId);
});

$app->get('/api/reports/listOrderIds', function () use ($app) {
    return Reports::listOrderIds();
});

$app->get('/api/reports/listSpeciesIds', function () use ($app) {
    return Reports::listSpeciesIds();
});

$app->get('/api/reports/listLocationIds', function () use ($app) {
    return Reports::listLocationIds();
});

$app->get('/api/reports/speciesForLocation/{locationId}', function ($locationId) use ($app) {
    return Reports::speciesForLocation($locationId);
});

$app->get('/api/reports/locationDetail/{locationId}', function ($locationId) use ($app) {
    return Reports::locationDetail($locationId);
});
