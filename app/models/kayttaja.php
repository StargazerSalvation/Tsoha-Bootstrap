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

    public $id, $nimi, $sposti, $yllapitaja, $salasana;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi','validate_sposti','validate_salasana');
    }
    
    public function validate_nimi() {
        return parent::validate_string_lenth($this->nimi, 3, 50);
    }
    
    public function validate_sposti(){
        return parent::validate_string_lenth($this->sposti, 6, 100);
    }
    
    public function validate_salasana(){
        return parent::validate_string_lenth($this->salasana, 4, 50);
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
    
    public static function tarkista_olemassaolo($ktunnus){
        $query = DB::connection()->prepare('SELECT * from kayttaja where nimi = :nimi');
        $query->execute(array('nimi' => $ktunnus));
        
        $rows = $query->fetchAll();
        
        return $rows;
    }
    
    public function tallenna(){
        $query = DB::connection()->prepare('INSERT INTO kayttaja (nimi, salasana, '
                . 'sposti) VALUES (:nimi, :salasana, :sposti)');
        $query->execute(array(
                        'nimi' => $this->nimi,
                        'salasana' => $this->salasana,
                        'sposti' => $this->sposti
                    )
                );
    }
}
