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
        View::make('drinkkien_listaus.html', array('drinkit' => $drinkit));
    }
    
    public static function nayta($id){
        $drinkki = Drinkki::etsi($id);
        View::make('drinkin_esittely.html', array('drinkki' => $drinkki));
    }
}
