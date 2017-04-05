<?php

$routes->get('/', function() {
    TaskController::index();
});

$routes->get('/task/index', function() {
    TaskController::index();
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

$routes->post('/task/:id/edit', function($id){
  TaskController::update($id);
});

$routes->post('/task/:id/destroy', function($id){
  TaskController::destroy($id);
});

$routes->get('/login', function(){
  PersonController::login();
});

$routes->post('/login', function(){
  PersonController::handle_login();
});

$routes->get('/', function () {
    PersonController::requireLogin();
});

$routes->get('/logout', function () {
    PersonController::logout();
});
