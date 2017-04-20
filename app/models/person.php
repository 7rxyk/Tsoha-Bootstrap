<?php

class Person extends BaseModel {

    public $id, $username, $passsword;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_username', 'validate_passsword');
    }

    public static function authenticate($username, $passsword) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE username = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'passsword' => $passsword));
        $row = $query->fetch();
        if ($row) {
            return new Person(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'passsword' => $row['password']
            ));
        } else {
            return null;
        }
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
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

}
