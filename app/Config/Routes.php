<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Login
$routes->get('/login', 'AuthController::loginForm');
$routes->post('/login', 'AuthController::login');

// Logout
$routes->get('/logout', 'AuthController::logout');

// Register
$routes->get('/register', 'AuthController::registerForm');
$routes->post('/register/save', 'AuthController::registerSave');

// Unauthorized
$routes->get('unauthorized', 'AuthController::unauthorized');

// ------------- Role Admin -------------
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    // Posts Page
    // $routes->get('posts', 'admin\PostsController::index');
    $routes->get('api/posts', 'admin\PostsController::index');
    $routes->get('posts', 'admin\PostsController::view');
    // PostDetail Page
    $routes->get('posts/(:segment)', 'admin\PostsController::detail/$1');
    // Users Page
    $routes->get('users_info', 'admin\UsersController::index');
    // UserDetail Page
    $routes->get('user_detail_info/(:num)', 'admin\UsersController::detail/$1');
    // Update Post
    $routes->post('updateApprover/(:segment)', 'admin\PostsController::updateApprover/$1');
    // Update Status
    $routes->post('updateStatus/(:segment)', 'admin\PostsController::updateStatus/$1');
    // Update User Detail
    $routes->post('updateUserDetail/(:num)', 'admin\UsersController::updateUserDetail/$1');
});

// ------------- Role Approver -------------
$routes->group('approver', ['filter' => 'role:approver'], function ($routes) {
    // Posts Page
    $routes->get('posts', 'approver\PostsController::index');
    // Posts Approval Page
    $routes->get('posts_approval', 'approver\PostsApprovalController::index');
    // Post Approval Detail Page
    $routes->get('post_approval_detail/(:segment)', 'approver\PostsApprovalController::detail/$1');
    // PostDetail Page
    $routes->get('posts/(:segment)', 'approver\PostsController::detail/$1');
    // My Profile Page
    $routes->get('my_profile', 'approver\MyProfileController::index');
    // Update User Detail
    $routes->post('updateUserDetail', 'approver\MyProfileController::updateUserDetail');
    // Update Status Aprooval Detail
    $routes->post('updateStatus/(:segment)', 'approver\PostsApprovalController::updateStatus/$1');
    // Submit Revision
    $routes->post('posts/action/(:segment)', 'approver\PostsController::submitRevision/$1');
});

// ------------- Role Writer -------------
$routes->group('writer', ['filter' => 'role:writer'], function ($routes) {
    // Posts Page
    $routes->get('posts', 'writer\PostsController::index');
    // PostDetail Page
    $routes->get('posts/(:segment)', 'writer\PostsController::detail/$1');
    // Post Form Page
    $routes->get('post_form', 'writer\PostFormController::postForm');
    // Post Form
    $routes->post('post_form/action', 'writer\PostFormController::postFormAction');
    // Submit Revision
    $routes->post('posts/action/(:segment)', 'writer\PostsController::submitRevision/$1');
    // Update User Detail
    $routes->post('updateUserDetail', 'writer\MyProfileController::updateUserDetail');
    // My Profile Page
    $routes->get('my_profile', 'writer\MyProfileController::index');
});
