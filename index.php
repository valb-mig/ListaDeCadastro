<?php

require __DIR__.'/vendor/autoload.php';

use \App\Controller\Pages\Home;
use \App\Controller\Pages\Login;
use \App\Controller\Pages\Register;

echo Home::getIndexHome();
