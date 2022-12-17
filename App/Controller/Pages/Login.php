<?php
    namespace App\Controller\Pages;

    use App\Utils\View;

    class Home
    {
        public static function getIndexLogin()
        {
            return View::renderViewContent('pages/login');
        }
    }
