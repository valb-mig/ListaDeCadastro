<?php
    namespace App\Controller\Pages;

    use App\Utils\View;

    class Home
    {
        public static function getIndexRegister()
        {
            return View::renderViewContent('pages/register');
        }
    }
