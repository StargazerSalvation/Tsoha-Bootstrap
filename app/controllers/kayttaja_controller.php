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
    
    public static function rekisteroidy(){
        View::make('kayttaja/rekisterointi.html');
    }
    
    public static function registeroi_kayttaja(){
        $params = $_POST;
        
        $rows = Kayttaja::tarkista_olemassaolo($params['kayttajatunnus']);
        
        $attribuutit = array('nimi' => $params['kayttajatunnus'],
                    'salasana' => $params['salasana1'],
                    'sposti' => $params['sposti']);
        $kayttaja = new Kayttaja($attribuutit);

        $errors = $kayttaja->errors();

        if ( $params['salasana1'] != $params['salasana2'] ){
            $errors[] = 'Salasanat eivät täsmää';
        }
        
        if (!$rows && count($errors == 0 )){
            $attribuutit = array('nimi' => $params['kayttajatunnus'],
                    'salasana' => $params['salasana1'],
                    'sposti' => $params['sposti']);
            $kayttaja->tallenna();
            Redirect::to('/login', array('message' => 'Kiitoksia rekisteröitymisestä, voit nyt kirjautua sisään!',
                                    'kayttajatunnus' => $kayttaja->nimi));
            
        }  else if ($rows) {
            $errors[] = 'Käyttäjätunnus on jo käytössä.';
            
            Redirect::to('/kayttaja/rekisterointi', 
                    array('errors' => $errors, 
                    'kayttajatunnus' => $params['kayttajatunnus'],
                        'sposti' => $params['sposti']));
            
        } else{           
            Redirect::to('/kayttaja/rekisterointi', 
                    array('errors' => $errors, 
                    'kayttajatunnus' => $params['kayttajatunnus'],
                        'sposti' => $params['sposti']));
            
        }
    }
    
    public static function listaa_kayttajat(){
        $kayttajat = Kayttaja::kaikki();
        
        View::make('kayttaja/kayttajat_listaus.html', array('kayttajat' => $kayttajat));
    }
}
