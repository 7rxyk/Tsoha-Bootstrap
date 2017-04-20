<?php


class BaseController {
    public static function get_user_logged_in() {
        if (isset($_SESSION['person'])) {
            $person_id = $_SESSION['person'];
            $person = Person::findOne($person_id);
            return $person;
        }
        return null;
    }

    public static function check_logged_in() {
        if (!isset($_SESSION['person'])) {
            Redirect::to('/', array('errors' => array('You are not logged in!')));
            return;
        }
        if(self::get_user_logged_in() === null) {
            unset($_SESSION['person']);
            Redirect::to('/', array('errors' => array('You are not logged in!')));
        }
    }

}