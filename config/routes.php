<?php

  $routes->get('/', function() {
      SessionController::index();
  });
  
  $routes->get('/login', function(){
      KayttajaController::kirjaudu();
  });
  
  $routes->post('/login', function(){
      KayttajaController::kirjaudu_sisaan();
  });
  
  $routes->get('/kayttajat', function(){
      KayttajaController::listaa_kayttajat(); 
  });
  
  $routes->get('/ehdotukset', function(){
      DrinkkiController::ehdotukset();
  });
  
  $routes->get('/drinkit', function(){
      DrinkkiController::listaa();
  });
  
  $routes->get('/muokkaa_drinkkia', function() {
      DrinkkiController::drinkin_muokkaus();
  });
  
  $routes->get('/ainesosat', function() {
      AinesosaController::listaa();
  });
 
  // näyttää lomakkeen
  $routes->get('/ainesosa/lisaa', function() {
    AinesosaController::lisaa();
  });
  // tallentaa kantaan
  $routes->post('/ainesosa/tallenna', function() {
      AinesosaController::tallenna();
  });
  
  $routes->get('/drinkit/:id', function($id){
      DrinkkiController::nayta($id);  
  });
  
  $routes->get('/ainesosa/:id', function($id){
      AinesosaController::nayta($id);
  });
  
  $routes->get('/ainesosa/:id/muokkaa', function($id){
      AinesosaController::muokkaa($id); 
  });
  
  $routes->post('/ainesosa/:id/muokkaa', function($id){
      AinesosaController::paivita($id);
  });
  
  $routes->post('/ainesosa/:id/poista', function($id){
      AinesosaController::poista($id); 
  });