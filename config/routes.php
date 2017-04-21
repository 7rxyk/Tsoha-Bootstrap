<?php

//login/register routes

$routes->get('/', function() {
    PersonController::login();
});
/*
$routes->post('/', function() {
    PersonController::handle_login();
});

$routes->get('/login', function() {
    PersonController::login();
});*/

$routes->post('/login', function() {
    PersonController::handle_login();
});

$routes->post('/logout', function () {
    PersonController::logout();
});

$routes->get('/register', function () {
    PersonController::registeringNeeded();
});
$routes->post('/register', function () {
    PersonController::register();
});

//task routes

$routes->get('/task/list', function() {
    TaskController::userTask();
});

$routes->get('/task/list', function() {
    TaskController::userTaskOnLogin();
});

$routes->get('/task/new', function() {
    TaskController::newTask();
});

$routes->post('/task/new', function() {
    TaskController::createNewTask();
});

$routes->get('/task/:id', function($id) {
    TaskController::oneTask($id);
});

$routes->get('/task/:id/edit', function ($id) {
    TaskController::edit($id);
});

$routes->post('/task/:id/edit', function($id) {
    TaskController::update($id);
});

$routes->post('/task/:id/destroy', function($id) {
    TaskController::destroy($id);
});

// category routes:

$routes->post('/category/:id/edit', function ($id) {
    CategoryController::update($id);
});
$routes->post('/category/:id/delete', function ($id) {
    CategoryController::destroy($id);
});
$routes->get('/category/all', function () {
    CategoryController::all();
});
$routes->get('/category/new', function () {
    CategoryController::newCategory();
});
$routes->post('/category/new', function () {
    CategoryController::createCategory();
});
