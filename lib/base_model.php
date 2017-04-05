<?php

  class BaseModel{

    protected $validators;

    public function __construct($attributes = null){
      foreach($attributes as $attribute => $value){
        if(property_exists($this, $attribute)){
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      $errors = array();
      foreach($this->validators as $validator){
        $errors += $this->{$validator}();
      }
      return $errors;
    }

    public static function validate_string_length($string, $minlength, $maxlength) {
        if ($string === null || !is_string($string) || strlen($string) < $minlength || strlen($string) > $maxlength) {
            return false;
        } else {
            return true;
        }
    }

    public static function number($id) {
        if ($id === null || !is_numeric($id) || $id < 1) {
            return false;
        } else {
            return true;
        }
    }

  }
