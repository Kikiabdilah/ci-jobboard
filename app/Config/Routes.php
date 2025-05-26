<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['as' => 'home']);
;

service('auth')->routes($routes);

//Jobs
$routes->get('jobs/single-job/(:num)', 'Jobs\JobsController::singleJob/$1', ['as' => 'single.job']);
$routes->get('jobs/category/(:any)', 'Jobs\JobsController::category/$1', ['as' => 'category.job']);

//Saving Jobs
$routes->post('jobs/save-job/(:num)', 'Jobs\JobsController::savedJobs/$1', ['as' => 'save.job']);


