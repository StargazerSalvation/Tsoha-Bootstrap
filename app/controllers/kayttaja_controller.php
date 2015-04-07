<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kayttaja_controller
 *
 * @author markus
 */
class KayttajaController {

    public static function kirjaudu(){
        View::make('login.html');
    }
    
    public static function kirjaudu_sisaan(){
        $params = $_POST;
                
        $kayttaja = Kayttaja::tunnistaudu($params['kayttajatunnus'], $params['salasana']);
        
        if (!$kayttaja){
            View::make('kayttaja/login.html', array('error' => 
                'Väärä käyttäjätunnus tai salasana!', 
                'kayttajatunnus' => $params['kayttajatunnus']));
        }else{
            $_SESSION['kayttaja'] = $kayttaja->id;
            $_SESSION['yllapitaja'] = $kayttaja->yllapitaja;
            
            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
        }
    }
    
    public static function listaa_kayttajat(){
        $kayttajat = Kayttaja::kaikki();
        
        View::make('kayttaja/kayttajat_listaus.html', array('kayttajat' => $kayttajat));
    }
}
