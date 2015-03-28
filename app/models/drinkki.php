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
