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
  $routes->post('/ainesosa/talleta', function() {
      AinesosaController::tallenna();
  });
  
    $routes->get('/drinkit/:id', function($id){
      DrinkkiController::nayta($id);  
  });
  
  $routes->get('/muokkaa_ainesosaa/:id', function($id){
      AinesosaController::ainesosan_muokkaus($id); 
  });