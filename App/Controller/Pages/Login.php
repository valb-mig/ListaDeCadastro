<?php
    namespace App\Controller\Pages;

    use App\Utils\View;
    use Core\Router;

    class Home extends Page
    {   
        public static function getIndex()
        {
            return View::renderViewContent('pages/login',[
                'page'        => 'Login',
                'description' => 'Pagina de login'
            ]);
        }
    }
