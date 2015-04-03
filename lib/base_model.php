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
          $errors = array_merge($errors, $this->{$validator}());
      }

      return $errors;
    }
    
    public function validate_string_lenth($string, $length){
        $errors = array();
        if ( $string == '' || $string == null ){
            $errors[] = ''. $string . ' ei saa olla tyhjä';
        }
        
        if (strlen($string) < $length ){
            $errors[] = '' . $string . ' pituuden tulee olla vähintään '. $length .' merkkiä';
        }
        
        return $errors;
    }

  }
