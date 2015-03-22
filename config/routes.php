<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/login', function(){
  HelloWorldController::login();
  });
  
  $routes->get('/drinkit', function(){
  HelloWorldController::drinkki_listaus();
  });
  
  $routes->get('/drinkit/1', function(){
    HelloWorldController::drinkin_esittely();  
  });
