<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ainesosa
 *
 * @author markus
 */
class Ainesosa extends BaseModel {
    
    public $id, $nimi, $tyyppi, $maara, $tietoa;
    //put your code here
    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_tyyppi');
    }
    
    public function validate_nimi(){
        return parent::validate_string_lenth($this->nimi, 3);
    }
    
    public function validate_tyyppi(){
        return parent::validate_string_lenth($this->tyyppi, 3);
    }
    
    public static function kaikki(){
        $query = DB::connection()->prepare('SELECT * from Ainesosat');
        $query->execute();
        
        $rows = $query->fetchAll();
        $ainesosat = array();
        
        foreach ($rows as $row){
            $ainesosat[] = new Ainesosa(
                    array(
                        'id' => $row['id'],
                        'nimi' => $row['nimi'],
                        'tyyppi' => $row['tyyppi'],
                        'tietoa' => $row['tietoa']
                        )
                    );
        }
        
        return $ainesosat;
    }
    
    public static function etsi($id){
        $query = DB::connection()->prepare('SELECT * FROM Ainesosat WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if ( $row ){
            $ainesosa = new Ainesosa( 
                    array(
                        'id' => $row['id'],
                        'nimi' => $row['nimi'],
                        'tyyppi' => $row['tyyppi'],
                        'tietoa' => $row['tietoa']
                        )
                    );
            return $ainesosa;
        }
        
        return null;
    }
    
    public function tallenna(){
        $query = DB::connection()->prepare('INSERT INTO ainesosat (nimi, tyyppi, '
                . 'tietoa) VALUES (:nimi, :tyyppi, :tietoa) RETURNING id');
        $query->execute(array(
                        'nimi' => $this->nimi,
                        'tyyppi' => $this->tyyppi,
                        'tietoa' => $this->tietoa
                    )
                );
        
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function paivita(){
        $query = DB::connection()->prepare('UPDATE ainesosat '
                . 'SET nimi = :nimi, tyyppi = :tyyppi, tietoa = :tietoa '
                . 'WHERE id = :id');
        $query->execute(array('nimi' => $this->nimi, 
                                'tyyppi' => $this->tyyppi, 
                                'tietoa' => $this->tietoa, 
                                'id' => $this->id));
    }
    
    public function poista(){
        $query = DB::connection()->prepare('DELETE FROM ainesosat WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }   
}
