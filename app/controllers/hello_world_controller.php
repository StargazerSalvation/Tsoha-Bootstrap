<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
          //echo 'Tämä on etusivu, katsotaan toimiiko ääkköset!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      //View::make('helloworld.html');
        $drinkki = Drinkki::find(1);
        $drinkit = Drinkki::all();
        
        Kint::dump($drinkki);
        Kint::dump($drinkit);
    }
    
    public static function login(){
        View::make('login.html');
    }
    
    public static function drinkki_listaus(){
        View::make('drinkkien_listaus.html');
    }
    
    public static function drinkin_esittely(){
        View::make('drinkin_esittely.html');
    }
    
    public static function drinkin_muokkaus(){
        View::make('drinkin_muokkaus.html');
    }
  }
