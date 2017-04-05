<?php

class Person extends BaseModel {

        // Attribuutit
    public $id, $username, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_username', 'validate_passsword');
    }
}
