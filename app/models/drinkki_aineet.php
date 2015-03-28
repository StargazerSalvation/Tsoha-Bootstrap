<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Drinkki_Aineet
 *
 * @author markus
 */
class Drinkki_Aineet extends BaseModel {
    
    public $drinkki_id, $aine_id, $maara;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public function haeAineetDrinkille($id){
        $query = DB::connection()->prepare('SELECT * from Drinkki_Aineet WHERE drinkki_id = :id');
        $query->execute(array('drinkki_id' => $id));
        $rows = $query->fetchAll();
        
        $aineet = array();
        
        foreach ( $rows as $row ){
            $aineet[] = Ainesosa::etsi($row['aine_id']);
        }
        
        return $aineet;
    }
    
    public function haeDrinkitAineelle($id){
        $query = DB::connection()->prepare('SELECT * from Drinkki_Aineet WHERE aine_id = :id');
        $query->execute(array('aine_id' => $id));
        $rows = $query->fetchAll();
        
        $drinkki_aineet = array();
        
        foreach ( $rows as $row ){
            $drinkit[] = Drinkki::etsi($row['drinkki_id']);
        }
        
        return $drinkit;
    }
}
