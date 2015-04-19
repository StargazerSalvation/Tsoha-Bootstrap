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
            $ehdottaja_id, $hyvaksytty_ehdotus, $ehdottaja, $maara;
    public  $aineet = array();
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi','validate_ajankohta', 
            'validate_makeus', 'validate_lasi', 'validate_lampotila',
            'validate_menetelma','validate_ohje');
    }
    
    public function validate_nimi(){
        return parent::validate_string_lenth($this->nimi, 4, 100);
    }
    
    public function validate_ajankohta(){
        return parent::validate_string_lenth($this->ajankohta, 2, 50);
    }
    
    public function validate_makeus(){
        return parent::validate_string_lenth($this->makeus, 3, 50);
    }
    
    public function validate_lasi(){
        return parent::validate_string_lenth($this->lasi, 3, 50);
    }
    
    public function validate_lampotila(){
        return parent::validate_string_lenth($this->lampotila, 3, 50);
    }
    
    public function validate_menetelma(){
        return parent::validate_string_lenth($this->menetelma, 3, 50);
    }
    
    public function validate_ohje(){
        return parent::validate_string_lenth($this->ohje, 10, 1000);
    }
    
    public static function kaikki(){
        
        //$query = DB::connection()->prepare('SELECT * from Drinkit where hyvaksytty_ehdotus = true');
        $query = DB::connection()->prepare('select *, (select count(*) from drinkki_aineet '
                . 'where drinkki_aineet.drinkki_id = drinkit.id) as maara, '
                . '(select nimi from kayttaja where id = drinkit.ehdottaja_id) '
                . 'as ehdottaja from drinkit where hyvaksytty_ehdotus = true');
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
                        'ehdottaja' => $row['ehdottaja'],
                        'hyvaksytty_ehdotus' => $row['hyvaksytty_ehdotus'],
                        'maara' => $row['maara']));
                        
        }
        
        return $drinkit;
    }
    
    public static function etsi($id){
        $query = DB::connection()->prepare('SELECT * FROM Drinkit WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        // ensin haetaan drinkki, jos löytyy niin tehdään drinkin tiedot
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
                        'hyvaksytty_ehdotus' => $row['hyvaksytty_ehdotus'],
                        'aineet' => array()
                        )
                    );
            // jonka jälkeen haetaan drinkkiin kuuluvat aineet, drinkki_aineet -taulusta
            $query = DB::connection()->prepare('SELECT *, (SELECT maara FROM '
                    . 'drinkki_aineet WHERE drinkki_id = :drinkki_id and aine_id = id) '
                    . 'as maara FROM ainesosat WHERE id in (SELECT aine_id FROM '
                    . 'drinkki_aineet WHERE drinkki_id = :drinkki_id)');
            $query->execute();
            $query->execute(array('drinkki_id' => $id));
            $aineet = $query->fetchAll();

            // ja lisätään aineet drinkin aineet -tauluun. array(array()).
            foreach ( $aineet as $aine ){

                $drinkki->aineet[] = new Ainesosa(
                    array(
                        'id' => $aine['id'],
                        'nimi' => $aine['nimi'],
                        'tyyppi' => $aine['tyyppi'],
                        'tietoa' => $aine['tietoa'],
                        'maara' => $aine['maara']
                        )
                    );
            }
            
            return $drinkki;
        }
        
        return null;
    }
    
    public static function ehdotukset(){
        $query = DB::connection()->prepare('SELECT * from Drinkit where hyvaksytty_ehdotus = false');
        $query->execute();
        
        $rows = $query->fetchAll();
        $ehdotukset = array();
        
        foreach ($rows as $row){
            $ehdotukset[] = new Drinkki(
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
        
        return $ehdotukset;
    }
    
    public function tallenna(){        
        $query = DB::connection()->prepare('INSERT INTO Drinkit (nimi, kuvaus, ohje, ajankohta, makeus, lasi, lampotila, menetelma, ehdottaja_id) VALUES (:nimi, :kuvaus, :ohje, :ajankohta, :makeus, :lasi, :lampotila, :menetelma, :ehdottaja_id) RETURNING id');
        $query->execute(array('nimi' => $this->nimi,
                        'kuvaus' => $this->kuvaus,
                        'ohje' => $this->ohje,
                        'ajankohta' => $this->ajankohta,
                        'makeus' => $this->makeus,
                        'lasi' => $this->lasi,
                        'lampotila' => $this->lampotila,
                        'menetelma' => $this->menetelma,
                        'ehdottaja_id' => $this->ehdottaja_id));
        
        $row = $query->fetch();
        $this->id = $row['id'];
        
        foreach ( $this->aineet as $aine ){
            $query = DB::connection()->prepare('INSERT INTO Drinkki_aineet (drinkki_id, aine_id, maara) VALUES (:drinkki_id, :aine_id, :maara');
            $query->execute(array('drinkki_id' => $this->id,
                                    'aine_id' => $aine['id'],
                                    'maara' => $aine['maara']));          
         
         
        }
        
    }
}
