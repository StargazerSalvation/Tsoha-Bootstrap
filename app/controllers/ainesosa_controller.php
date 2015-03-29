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
class AinesosaController {
    public static function listaa(){
        $ainesosat = Ainesosa::kaikki();
        View::make('ainesosa/ainesosien_listaus.html', array('ainesosat' => $ainesosat));
    }
    
    public static function ainesosan_muokkaus($id){
        $aineosa = Ainesosa::etsi($id);
        View::make('ainesosa/ainesosan_muokkaus.html', array('ainesosa' => $aineosa));
    }
    
    // näyttää lomakkeen
    public static function lisaa(){
        View::make('ainesosa/ainesosan_lisays.html');
    }
    
    // tallettaa kantaan
    public static function tallenna(){
        $params = $_POST;
        
        $ainesosa = new Ainesosa(array(
                    'nimi' => $params['nimi'],
                    'tyyppi' => $params['tyyppi'],
                    'tietoa' => $params['tietoa']
                    )
                );
        
        $ainesosa->tallenna();
        
        Redirect::to('/muokkaa_ainesosaa/' . $ainesosa->id, array('message'=> 'Ainesosa lisätty'));
    }
}
