<?php

class BaseController {

    public static function get_user_logged_in() {
        if (isset($_SESSION['person'])) {
            $person_id = $_SESSION['person'];
            $person = Person::findUser($person_id);
            return $person;
        }
        return null;
    }

    public static function check_logged_in() {
        if (!isset($_SESSION['person'])) {
            Redirect::to('/', array('message' => 'You are not logged in, either Username or Password was wrong'));
            return;
        }
    }

    public static function not_logged() {
        if (isset($_SESSION['person'])) {
            Redirect::to('/list', array('errors' => array('You are already logged in!')));
        }
    }

}
