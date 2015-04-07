<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kayttaja
 *
 * @author markus
 */
class Kayttaja extends BaseModel {

    public $id, $nimi, $sposti, $yllapitaja;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function tunnistaudu($kayttajatunnus, $salasana){
        
        $query = DB::connection()->prepare(
                'SELECT * FROM Kayttaja WHERE nimi = :kayttajatunnus and salasana = :salasana LIMIT 1');
        $query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
        $row = $query->fetch();

        if ( $row ){
            $kayttaja = new Kayttaja(array('id' =>  $row['id'], 
                                            'nimi' => $row['nimi'],
                                            'sposti' => $row['sposti'],
                                            'yllapitaja' => $row['yllapitaja']));
            
            return $kayttaja;
        }
        else{
            return null;
        }
    }
    
        
    public static function etsi($id){
        $query = DB::connection()->prepare('SELECT * from kayttaja where id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ( $row ){
            $kayttaja = new Kayttaja(array('id' =>  $row['id'], 
                                            'nimi' => $row['nimi'],
                                            'sposti' => $row['sposti'],
                                            'yllapitaja' => $row['yllapitaja']));
            
            return $kayttaja;
        }else{
            return null;
        }
    }
    
    public static function kaikki(){
        $query = DB::connection()->prepare('SELECT * from kayttaja');
        $query->execute();
        
        $rows = $query->fetchAll();
        
        $kayttajat = array();
        
        foreach ( $rows as $row ){
            $kayttajat[] = new Kayttaja(array('id' =>  $row['id'], 
                                            'nimi' => $row['nimi'],
                                            'sposti' => $row['sposti'],
                                            'yllapitaja' => $row['yllapitaja']));
        }
        
        return $kayttajat;
    }
}
