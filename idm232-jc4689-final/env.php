<?php
  consoleMsg("env.php file LOADED!");

  $domain = $_SERVER['HTTP_HOST'];
  consoleMsg("Domain is: $domain");

  if($domain == 'localhost:8888') {
    // Specific to the current environment you're on.
    $APP_CONFIG = [
      'environment' => 'local',
      'site_url' => 'http://localhost:8888/',
      'database_host' => 'localhost',
      'database_user' => 'root',
      'database_pass' => 'root',
      'database_name' => 'idm232',
    ];
  } else {
    // Specific to the current environment you're on.
    $APP_CONFIG = [
      'environment' => 'live',
      'site_url' => 'https://www.joechindemi.com/',
      'database_host' => 'mysql.joechindemi.com',
      'database_user' => 'joecookbook',
      'database_pass' => 'AbbyStardust1129!!!',
      'database_name' => 'joechindemi_idm232',
    ];
  }

  // $APP_CONFIG = [
  //   'environment' => 'local',
  //   'site_url' => 'http://localhost:8888/',
  //   'database_host' => 'localhost',
  //   'database_user' => 'root',
  //   'database_pass' => 'root',
  //   'database_name' => 'idm232',
  // ];
  
?>