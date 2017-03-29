<?php

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

// Etusivu (taskien listaussivu)
$routes->get('/', function(){
  TaskController::index();
});
// taskien listaussivu
$routes->get('/task', function(){
  TaskController::index();
});

// taskien lisääminen tietokantaan
$routes->post('/task', function(){
  TaskController::store();
});
// taskien lisäyslomakkeen näyttäminen
$routes->get('/task/new', function(){
  TaskController::create();
});
// Määritetään reitti task/:id vasta tässä, jottei se mene sekaisin reitin task/new kanssa
// taskien esittelysivu
$routes->get('/task/:id', function($id){
  TaskController::show($id);
});