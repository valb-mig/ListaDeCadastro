<?php
use \Core\Router;

require __DIR__.'/vendor/autoload.php';

use \App\Controller\Pages\Home;
use \App\Controller\Pages\Login;
use \App\Controller\Pages\Register;


echo Home::getIndex();

// echo Router::routes();
