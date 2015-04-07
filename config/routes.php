<?php

  $routes->get('/', function() {
      SessionController::index();
  });
  
  $routes->get('/login', function(){
      SessionController::kirjaudu();
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