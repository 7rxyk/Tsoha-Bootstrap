<?php


// Etusivu (taskien listaussivu)
$routes->get('/', function() {
    TaskController::index();
});

// taskien listaussivu
$routes->get('/task/index', function() {
    TaskController::index();
});

// taskien lisääminen tietokantaan
$routes->post('/task', function() {
    TaskController::store();
});

// taskien lisäyslomakkeen näyttäminen
$routes->get('/task/new', function() {
    TaskController::newTask();
});

// Määritetään reitti task/:id vasta tässä, jottei se mene sekaisin reitin task/new kanssa
// taskien esittelysivu
$routes->get('/task/:id', function($id) {
    TaskController::showTask($id);
});
//Taskin muokkaus
$routes->get('/task/:id/edit', function ($id) {
    TaskController::edit($id);
});

$routes->post('/task/:id/edit', function($id){
  TaskController::update($id);
});

$routes->post('/task/:id/destroy', function($id){
  // Pelin poisto
  TaskController::destroy($id);
});

$routes->get('/login', function(){
  // Kirjautumislomakkeen esittäminen
  PersonController::login();
});

$routes->post('/login', function(){
  // Kirjautumisen käsittely
  PersonController::handle_login();
});

$routes->get('/', function () {
    PersonController::requireLogin();
});

$routes->get('/logout', function () {
    PersonController::logout();
});
