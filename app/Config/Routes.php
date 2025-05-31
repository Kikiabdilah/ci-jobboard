<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['as' => 'home']);
$routes->get('/contact', 'Home::contact', ['as' => 'contact']);
$routes->get('/about', 'Home::about', ['as' => 'about']);

service('auth')->routes($routes);

//Jobs
$routes->get('jobs/single-job/(:num)', 'Jobs\JobsController::singleJob/$1', ['as' => 'single.job']);
$routes->get('jobs/category/(:any)', 'Jobs\JobsController::category/$1', ['as' => 'category.job']);

//Saving Jobs
$routes->post('jobs/save-job/(:num)', 'Jobs\JobsController::savedJobs/$1', ['as' => 'save.job']);


//apllying jobs
$routes->post('jobs/apply-jobs/(:num)', 'Jobs\JobsController::applyJobs/$1', ['as' => 'apply.jobs']);

//User Profile
$routes->get('users/public-profile/(:num)', 'Users\UsersController::publicProfile/$1', ['as' => 'public.profile.users']);

//updating user profile
$routes->get('users/update-profile', 'Users\UsersController::updateProfile', ['as' => 'update.profile.users']);
$routes->post('users/update-profile', 'Users\UsersController::submitUpdateProfile', ['as' => 'submit.profile.users']);


//update user cv
$routes->get('users/update-cv', 'Users\UsersController::updateCV', ['as' => 'update.cv.users']);
$routes->post('users/update-cv', 'Users\UsersController::submitUpdateCV', ['as' => 'submit.cv.users']);


//get user saved jobs
$routes->get('users/saved-jobs', 'Users\UsersController::userSavedJobs', ['as' => 'saved.jobs.users']);
//get user applied jobs
$routes->get('users/applyed-jobs', 'Users\UsersController::userApplyedJobs', ['as' => 'applyed.jobs.users']);