<?php

//login/register routes

$routes->get('/', function() {
    PersonController::login();
});
/*
$routes->post('/', function() {
    PersonController::handle_login();
});*/

$routes->get('/login', function() {
    PersonController::login();
});

$routes->post('/login', function() {
    PersonController::handle_login();
});

$routes->get('/register', function () {
    PersonController::registeringNeeded();
});
$routes->post('/register', function () {
    PersonController::register();
});

$routes->get('/logout', function () {
    PersonController::logout();
});

//task routes

$routes->get('/list', function() {
    TaskController::userTasks();
});

$routes->get('/task/new', function() {
    TaskController::newTask();
});

$routes->post('/task/new', function() {
    TaskController::createNewTask();
});

$routes->get('/task/:id', function($id) {
    TaskController::findTask($id);
});

$routes->get('/task/:id/edit', function ($id) {
    TaskController::edit($id);
});

$routes->post('/task/:id/edit', function($id) {
    TaskController::update($id);
});

$routes->get('/task/:id/delete', function($id) {
    TaskController::destroy($id);
});

// category routes:

$routes->get('/category/:id/edit', function ($id) {
    CategoryController::edit($id);
});

$routes->post('/category/:id/edit', function ($id) {
    CategoryController::update($id);
});
$routes->get('/category/:id/delete', function ($id) {
    CategoryController::destroy($id);
});
/*
$routes->post('/category/:id/delete', function ($id) {
    CategoryController::destroy($id);
});*/
$routes->get('/category/all', function () {
    CategoryController::allByUser();
});
$routes->get('/category/new', function () {
    CategoryController::newCategory();
});
$routes->post('/category/new', function () {
    CategoryController::createCategory();
});


