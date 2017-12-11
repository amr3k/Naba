<?php

require __DIR__ . '/vendor/System/App.php';
require __DIR__ . '/vendor/System/File.php';

use System\File;
use System\app;

$file = new File(__DIR__);
$app  = app::getInstance($file);
$app->run();
