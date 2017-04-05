<?php

require 'app/models/person.php';

class PersonController extends BaseController {


    public static function login() {
        View::make('person/login.html');
    }

    public static function handle_login() {
        $params = $_POST;
        $person = Person::authenticate($params['username'], $params['password']);

        if (!$person) {
            View::make('person/login.html', array('error' => 'Wrong username or password!', 'username' => $params['username']));
        } else {
            $_SESSION['person'] = $person->id;
            Kint::dump($params);
            Redirect::to("/task/list");
        }
    }

    public static function logout() {
        $_SESSION['person'] = null;
        Redirect::to('/login', array('message' => 'You are logged out!'));
    }
    
    public static function find($id) {
        return Person::find($id);
    }

}
