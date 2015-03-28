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
    
    public $id, $nimi, $tyyppi, $maara;
    //put your code here
    public function __construct($attributes = null) {
        parent::__construct($attributes);
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
                        'tyyppi' => $row['tyyppi']
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
                        'tyyppi' => $row['tyyppi']
                        )
                    );
            return $ainesosa;
        }
        
        return null;
    }
    
}
