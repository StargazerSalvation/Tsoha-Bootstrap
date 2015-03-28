<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/login', function(){
  HelloWorldController::kirjaudu();
  });
  
  $routes->get('/drinkit', function(){
      DrinkkiController::listaa();
  });
  
  $routes->get('/drinkit/:id', function($id){
      DrinkkiController::nayta($id);  
  });
  
  $routes->get('/muokkaa', function() {
      HelloWorldController::drinkin_muokkaus();
  });
