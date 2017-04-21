<?php

class Person extends BaseModel {

    public $id, $username, $passsword;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_username', 'validate_passsword');
    }

    public static function authenticate($username, $passsword) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE username = :username AND passsword = :passsword LIMIT 1');
        $query->execute(array('username' => $username, 'passsword' => $passsword));
        $row = $query->fetch();
        if ($row) {
            return new Person(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'passsword' => $row['passsword']
            ));
        } else {
            return null;
        }
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO person (username, passsword) VALUES (:username, :passsword) RETURNING id');
        $query->execute(array('username' => $this->username, 'passsword' => $this->passsword));
        $row = $query->fetch();
        $this->id = $row['id'];
        
        /*
        $person = new Person(array(
            'id' => $row['id'],
            'username' => $row['username'],
            'passsword' => $row['passsword']
        ));*/
        
    }


    public static function findUser($id) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $person = new Person(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'passsword' => $row['passsword'],
            ));
            return $person;
        }
        return null;
    }


    public static function findByUsername($username) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE username = :username LIMIT 1');
        $query->execute(array('username' => $username));
        $row = $query->fetch();
        if ($row) {
            $person = new Person(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'passsword' => $row['passsword']
            ));
            return $person;
        }
        return null;
    }

    public function categories() {
        return Category::findAll($this->id);
    }

    public function validate_username() {
        $errors = array();
        if (self::validate_length($this->username, 3, 20) === false) {
            $errors[] = 'Choose username that\'s lenght is 3-20 letters!';
        }
        return $errors;
    }

    public function validate_passsword() {
        $errors = array();
        if (self::validate_length($this->passsword, 3, 20) === false) {
            $errors[] = 'Choose password that\'s lenght is 3-20 letters!';
        }
        return $errors;
    }

}
