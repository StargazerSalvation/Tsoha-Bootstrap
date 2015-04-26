<?php

  $routes->get('/', function() {
      KayttajaController::index();
  });
  
  $routes->get('/login', function(){
      KayttajaController::kirjaudu();
  });
  
  $routes->post('/login', function(){
      KayttajaController::kirjaudu_sisaan();
  });
  
  $routes->post('/logout', function(){
      KayttajaController::kirjaudu_ulos();
  });
  
  $routes->get('/kayttaja/rekisterointi', function(){
      KayttajaController::rekisteroidy();
  });
  
  $routes->post('/kayttaja/rekisterointi', function(){
      KayttajaController::registeroi_kayttaja(); 
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
  
  $routes->post('/drinkit/hyvaksy/:id', function($id){
      DrinkkiController::hyvaksy_drinkiksi($id);
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
  
  $routes->get('/drinkit/lisaa', function(){
      DrinkkiController::lisaa();
  });
  
  $routes->post('/drinkit/tallenna', function(){
  DrinkkiController::tallenna();
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
  
  $routes->get('/muokkaa_drinkkia/:id', function($id) {
      DrinkkiController::drinkin_muokkaus($id);
  });
  
  $routes->post('/drinkit/:id/muokkaa', function($id){
      DrinkkiController::paivita($id);
  });