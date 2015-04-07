<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ainesosa_controller
 *
 * @author markus
 */
class AinesosaController extends BaseController{
    public static function listaa(){
        $ainesosat = Ainesosa::kaikki();
        View::make('ainesosa/ainesosien_listaus.html', array('ainesosat' => $ainesosat));
    }
    
    public static function nayta($id){
        $ainesosa = Ainesosa::etsi($id);
        View::make('ainesosa/ainesosa_esittely.html', array('ainesosa'=> $ainesosa));
    }
    
    public static function muokkaa($id){
        $aineosa = Ainesosa::etsi($id);
        View::make('ainesosa/ainesosan_muokkaus.html', array('ainesosa' => $aineosa));
    }
    
    public static function paivita($id){
        $params = $_POST;
        
        $attribuutit = array('id' => $id, 
                    'nimi' => $params['nimi'],
                    'tyyppi' => $params['tyyppi'],
                    'tietoa' => $params['tietoa']);
        
        $ainesosa = new Ainesosa($attribuutit);
        
        $errors = $ainesosa->errors();
        
        if ( count($errors) > 0 ){
            View::make('ainesosa/ainesosan_muokkaus.html', 
                    array('errors' => $errors, 'ainesosa' => $attribuutit));
        }else{
            $ainesosa->paivita();
            
            Redirect::to('/ainesosa/' . $ainesosa->id, 
                    array('message' => 'Ainesosaa päivitetty!'));
        }
    }
    
    // näyttää lomakkeen
    public static function lisaa(){
        View::make('ainesosa/ainesosan_lisays.html');
    }
    
    public static function poista($id){
        $ainesosa = new Ainesosa(array('id' => $id));
        
        $ainesosa->poista();
        
        Redirect::to('/ainesosat', array('message' => 'Ainesosa poistettu!'));
    }
    
    // tallettaa kantaan
    public static function tallenna(){
        $params = $_POST;
        
        $attribuutit = array('nimi' => $params['nimi'],
                    'tyyppi' => $params['tyyppi'],
                    'tietoa' => $params['tietoa']);
        $ainesosa = new Ainesosa($attribuutit);
        
        $errors = $ainesosa->errors();
        
        if ( count($errors) == 0){
            $ainesosa->tallenna();
            Redirect::to('/ainesosa/' . $ainesosa->id, array(
                'message'=> 'Ainesosa lisätty'));
        }else {
            View::make('/ainesosa/ainesosan_lisays.html', array(
                'errors' => $errors, 'attributes' => $attribuutit));
        }
    }
}
