<?php

require 'app/models/person.php';

class PersonController extends BaseController {


    public static function login() {
        self::check_logged_in();
        View::make('person/login');
    }

    public static function handle_login() {
        self::check_logged_in();
        $params = $_POST;
        $person = Person::authenticate($params['username'], $params['passsword']);

        if (!$person) {
            View::make('person/login', array('error' => 'Wrong username or password!', 'username' => $params['username']));
        } else {
            $_SESSION['person'] = $person->id;
          
            Redirect::to("/task/list");
        }
    }

        public static function registeringNeeded() {
        self::check_logged_in();
        View::make('/person/new.html');
    }

    public static function register()  {
        $params = $_POST;
        $person = new person(array(
            'username' => $params['username'],
            'passsword' => $params['passsword'],
        ));
        $errors = $person->errors();
        if (person::findByName($person->username) != null) {
            $errors += array('Username already exists.');
        }
        if (count($errors) > 0) {
            View::make('/person/new.html', array('errors' => $errors, 'username' => $person->username));
        } else {
            $person->save();
            Redirect::to('/task/list.html', array('message' => 'User has been successfully created!'));
        }
    }

    public static function logout() {
        $_SESSION['person'] = null;
        Redirect::to('/', array('message' => 'You are logged out!'));
    }
    
    public static function find($id) {
        return Person::find($id);
    }

}
