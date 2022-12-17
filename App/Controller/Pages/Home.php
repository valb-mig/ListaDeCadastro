<?php
    namespace App\Controller\Pages;

    use App\Utils\View;

    class Home
    {
        public static function getIndexHome()
        {
            return View::renderViewContent('pages/home');
        }
    }
