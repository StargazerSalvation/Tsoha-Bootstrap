<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sessioncontroller
 *
 * @author markus
 */
class SessionController extends BaseController {
    
    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }
    
    public static function kirjaudu(){
        View::make('login.html');
    }
}