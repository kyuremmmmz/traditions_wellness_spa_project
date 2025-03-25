<?php
use App\Controllers\Web\RevenueController;

$router->get('/getWeeklyRevenue/:year/:month/:week', function($year, $month, $week) {
    $controller = new RevenueController();
    echo $controller->getWeeklyRevenue($year, $month, $week);
});

$router->get('/getMonthlyRevenue/:year/:month', function($year, $month) {
    $controller = new RevenueController();
    echo $controller->getMonthlyRevenue($year, $month);
});

$router->get('/getYearlyRevenue/:year', function($year) {
    $controller = new RevenueController();
    echo $controller->getYearlyRevenue($year);
});