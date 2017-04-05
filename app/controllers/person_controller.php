<?php
require 'app/models/person.php';
class PersonController extends BaseController{

  public static function requireLogin() {
        self::check_not_logged_in();
        View::make('/person/login.html');
    }

  public static function login(){
      View::make('person/login.html');
  }

  public static function handle_login(){
    $params = $_POST;
    $person = Person::authenticate($params['username'], $params['password']);

    if(!$user){
      View::make('person/login.html', array('error' => 'Wrong username or password!', 'username' => $params['username']));
    }else{
      $_SESSION['user'] = $person->id;

      Redirect::to('/', array('message' => 'Welcome back ' . $person->name . '!'));
    }
  }

    public static function logout(){
      $_SESSION['user'] = null;
      Redirect::to('/login', array('message' => 'You are logged out!'));
  }
}