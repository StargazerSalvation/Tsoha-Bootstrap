<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of drinkki_controller
 *
 * @author markus
 */
class DrinkkiController extends BaseController{
    public static function listaa(){
        $drinkit = Drinkki::kaikki();
        View::make('drinkki/drinkkien_listaus.html', array('drinkit' => $drinkit));
    }
    
    public static function nayta($id){
        $drinkki = Drinkki::etsi($id);
        View::make('drinkki/drinkin_esittely.html', array('drinkki' => $drinkki));
    }
    
    public static function hyvaksy_drinkiksi($id){
        Drinkki::hyvaksy($id);
        Redirect::to('/drinkit/' . $id, array('message'=> 'Drinkki hyväksytty'));
    }
    
    public static function drinkin_muokkaus($id){
        self::check_logged_in();
        $drinkki = Drinkki::etsi($id);
        $ainesosat = Ainesosa::kaikki();
        View::make('drinkki/drinkin_muokkaus.html', 
                array('drinkki' => $drinkki, 'kaikki_aineet' => $ainesosat));
    }
    
    public static function  ehdotukset(){
        $ehdotukset = Drinkki::ehdotukset();
        View::make('drinkki/drinkki_ehdotukset.html', array('ehdotukset' => $ehdotukset));
    }
    
    // näyttää lomakkeen
    public static function lisaa(){
        self::check_logged_in();
        $ainesosat = Ainesosa::kaikki();
        View::make('drinkki/drinkin_lisays.html', array('ainesosat' => $ainesosat));
    }
    
    // päivittää kantaan drinkin tiedot uusilla tiedoilla.
    public static function paivita($id){
        
        $params = $_POST;
        $aineet = $params['aineet'];
        $maara = $params['maara'];
        
        $attribuutit = array('id' => $id,
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'ohje' => $params['ohje'],
            'ajankohta' => $params['ajankohta'],
            'makeus' => $params['makeus'],
            'lasi' => $params['lasi'],
            'lampotila' => $params['lampotila'],
            'menetelma' => $params['menetelma'],
            'hyvaksytty_ehdotus' => false);
        
        $drinkki = new Drinkki($attribuutit);
        
        $errors = $drinkki->errors();
        
        $drinkki->aineet = array();
        
        $tmparray = array();
        $virhe_olemassa = false;
        for ( $i = 0; $i < 10; $i++){            
            if (strlen($maara[$i]) > 0 )
            {
                if (in_array($aineet[$i], $tmparray, true)  && !$virhe_olemassa)
                {
                    $errors[] = 'Sama ainesosa ei saa esiintyä enempää kuin kerran!';    
                }
                else{
                    $tmparray[] = $aineet[$i];
                }

                $drinkki->aineet[] = array('id' => $aineet[$i], 
                        'maara' => $maara[$i]);
            }
        }

        if (count($drinkki->aineet) <= 1){
            $errors[] = 'Ainesosia pitäisi olla enemmän kuin 1.';
        }
        
        if ( count($errors) == 0){    
            $drinkki->paivita();
            
            Redirect::to('/drinkit/' . $drinkki->id, array('message'=> 'Drinkkiä muokattu, drinkki muutettu ehdotukseksi!'));
        }else {
            $ainesosat = Ainesosa::kaikki();
            View::make('drinkki/drinkin_muokkaus.html', 
                array('errors' => $errors,
                    'drinkki' => $drinkki, 
                    'kaikki_aineet' => $ainesosat));
        }
    }
    
    // tallettaa kantaan uuden drinkin, ja siihen liittyvät ainesosat
    public static function tallenna(){
        $params = $_POST;
        
        $aineet = $params['aineet'];
        $maara = $params['maara'];
        
        $attribuutit = array('nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'ohje' => $params['ohje'],
            'ajankohta' => $params['ajankohta'],
            'makeus' => $params['makeus'],
            'lasi' => $params['lasi'],
            'lampotila' => $params['lampotila'],
            'menetelma' => $params['menetelma'],
            'ehdottaja_id' => $_SESSION['kayttaja'],
            'hyvaksytty_ehdotus' => false);

        $drinkki = new Drinkki($attribuutit);
        
        $errors = $drinkki->errors();
        
        $drinkki->aineet = array();
        $virhe_olemassa = false;
        $tmparray = array();
        for ( $i = 0; $i < 10; $i++){
            if (strlen($maara[$i]) > 0 )
            {
                if (in_array($aineet[$i], $tmparray, true) && !$virhe_olemassa)
                {
                    $errors[] = 'Sama ainesosa ei saa esiintyä enempää kuin kerran!';    
                }
                else{
                    $tmparray[] = $aineet[$i];
                }

                $drinkki->aineet[] = array('id' => $aineet[$i], 
                        'maara' => $maara[$i]);
            }
        }

        if (count($drinkki->aineet) <= 1){
            $errors[] = 'Ainesosia pitäisi olla enemmän kuin 1.';
        }
        
        if ( count($errors) == 0){    
            $drinkki->tallenna();
            
            Redirect::to('/drinkit/' . $drinkki->id, array('message'=> 'Drinkki lisätty'));
        }else {
            $ainesosat = Ainesosa::kaikki();
            View::make('/drinkki/drinkin_lisays.html', array(
                'errors' => $errors, 
                'drinkki' => $attribuutit,
                'ainesosat' => $aineet,
                'maara' => $maara,
                'ainesosat' => $ainesosat));
        }
    }
}
