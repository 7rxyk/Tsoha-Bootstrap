<?php

  class BaseController{

  public static function get_user_logged_in(){
    if(isset($_SESSION['user'])){
      $person_id = $_SESSION['user'];

      $person = Person::find($person_id);
      return $person;
    }
    return null;
  }

    public static function check_logged_in(){
        if(!isset($_SESSION['user'])){
          Redirect::to('/login', array('message' => 'Login to see To do -list!'));
          }
      }
  }
