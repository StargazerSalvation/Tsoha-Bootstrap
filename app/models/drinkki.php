<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Drinkki
 *
 * @author markus
 */
class Drinkki extends BaseModel {
    
    public $id, $nimi, $kuvaus, $ohje, $ajankohta, 
            $makeus, $lasi, $lampotila, $menetelma, 
            $ehdottaja_id, $hyvaksytty_ehdotus, $ehdottaja, $aineet;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi','validate_ajankohta', 
            'validate_makeus', 'validate_lasi', 'validate_lampotila',
            'validate_menetelma','validate_menetelma','validate_ohje');
    }
    
    public function validate_nimi(){
        return parent::validate_string_lenth($this->nimi, 4);
    }
    
    public function validate_ajankohta(){
        return parent::validate_string_lenth($this->ajankohta, 2);
    }
    
    public function validate_makeus(){
        return parent::validate_string_lenth($this->makeus, 3);
    }
    
    public function validate_lasi(){
        return parent::validate_string_lenth($this->lasi, 3);
    }
    
    public function validate_lampotila(){
        return parent::validate_string_lenth($this->lampotila, 3);
    }
    
    public function validate_menetelma(){
        return parent::validate_string_lenth($this->menetelma, 3);
    }
    
    public function validate_ohje(){
        return parent::validate_string_lenth($this->ohje, 10);
    }
    
    
    public static function kaikki(){
        
        $query = DB::connection()->prepare('SELECT * from Drinkit');
        $query->execute();
        
        $rows = $query->fetchAll();
        $drinkit = array();
        
        foreach ($rows as $row){
            $drinkit[] = new Drinkki(
                    array('id' => $row['id'],
                        'nimi' => $row['nimi'],
                        'kuvaus' => $row['kuvaus'],
                        'ohje' => $row['ohje'],
                        'ajankohta' => $row['ajankohta'],
                        'makeus' => $row['makeus'],
                        'lasi' => $row['lasi'],
                        'lampotila' => $row['lampotila'],
                        'menetelma' => $row['menetelma'],
                        'ehdottaja_id' => $row['ehdottaja_id'],
                        'hyvaksytty_ehdotus' => $row['hyvaksytty_ehdotus']));
                        
        }
        
        return $drinkit;
    }
    
    public static function etsi($id){
        $query = DB::connection()->prepare('SELECT * FROM Drinkit WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if ( $row ){
            $drinkki = new Drinkki(
                    array(
                        'id' => $row['id'],
                        'nimi' => $row['nimi'],
                        'kuvaus' => $row['kuvaus'],
                        'ohje' => $row['ohje'],
                        'ajankohta' => $row['ajankohta'],
                        'makeus' => $row['makeus'],
                        'lasi' => $row['lasi'],
                        'lampotila' => $row['lampotila'],
                        'menetelma' => $row['menetelma'],
                        'ehdottaja_id' => $row['ehdottaja_id'],
                        'hyvaksytty_ehdotus' => $row['hyvaksytty_ehdotus']
                        )
                    );
            
            return $drinkki;
        }
        
        return null;
    }
}
