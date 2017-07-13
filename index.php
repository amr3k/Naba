<?php

/*
  <!--Night mode :)-->

  <head>
  <title>Z</title>
  <style>
  body{
  background-color: #221;
  color: #cfc;
  }
  </style>
  </head>

 */
require __DIR__ . '/Vendor/System/App.php';
require __DIR__ . '/Vendor/System/File.php';

use System\File;
use System\App;

$file = new File(__DIR__);
$app  = App::getInstance($file);
$app->run();
