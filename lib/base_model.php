<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();
      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
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
