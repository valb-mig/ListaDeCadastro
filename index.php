<?php
require __DIR__.'/vendor/autoload.php';

use \App\Utils\View;
use \App\Http\Router;

define('URL','http://localhost:8080');

View::init([
    'URL' => URL,
]);

$objRouter = new Router(URL);

include __DIR__.'/Routes/pages.php';

$objRouter->run()
          ->sendResponse();
