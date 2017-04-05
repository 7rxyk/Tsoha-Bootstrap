<?php

$routes->get('/', function() {
    PersonController::login();
});

$routes->get('/login', function() {
    PersonController::login();
});

$routes->post('/login', function() {
    PersonController::handle_login();
});

$routes->post('/logout', function () {
    PersonController::logout();
});

$routes->get('/task/list', function() {
    TaskController::userTask();
});

$routes->get('/task/listNewLogin', function() {
    TaskController::userTaskOnLogin();
});

$routes->post('/task', function() {
    TaskController::store();
});

$routes->get('/task/new', function() {
    TaskController::newTask();
});

$routes->get('/task/:id', function($id) {
    TaskController::showTask($id);
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
