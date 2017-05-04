<?php

class PersonController extends BaseController {

    public static function login() {
        self::not_logged();
        View::make('/person/login.html');
    }

    public static function handle_login() {
        self::not_logged();
        $params = $_POST;
        $person = Person::authenticate($params['username'], $params['passsword']);

        if (!$person) {
            View::make('/person/login.html', array('error' => 'Wrong username or password!', 'username' => $params['username']));
        } else {
            $_SESSION['person'] = $person->id;
            Redirect::to('/list');
        }
    }

    public static function registeringNeeded() {
        self::not_logged();
        View::make('/person/new.html');
    }

    public static function register() {
        self::not_logged();
        $params = $_POST;
        $person = new Person(array(
            'username' => $params['username'],
            'passsword' => $params['passsword']
        ));
        $errors = $person->errors();
        if (Person::findByUsername($person->username) != null) {
            $errors += array('Username already exists.');
        }
        if (count($errors) > 0) {
            View::make('/person/new.html', array('errors' => $errors, 'username' => $person->username));
        } else {
            $person->save();
            Redirect::to('/list', array('message' => 'User has been successfully created!'));
        }
    }

    public static function logout() {
        $_SESSION['person'] = null;
        Redirect::to('/login', array('message' => 'You are logged out!'));
    }

    public static function find($id) {
        return Person::findUser($id);
    }

}
