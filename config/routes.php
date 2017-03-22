<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/todolist', function() {
    HelloWorldController::todo_list();
});
$routes->get('/task/modify', function() {
    HelloWorldController::modify();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});

$routes->get('/new', function() {
    HelloWorldController::newTask();
});
