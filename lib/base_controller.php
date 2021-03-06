<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Toteuta kirjautuneen käyttäjän haku tähän
      if ( isset($_SESSION['kayttaja'])){
          $user_id = $_SESSION['kayttaja'];
          
          $kayttaja = Kayttaja::etsi($user_id);
          
          return $kayttaja;
      }
      else
      {
          return null;
      }
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
        if ( !isset($_SESSION['kayttaja'])){
            Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
        }
    }

  }
