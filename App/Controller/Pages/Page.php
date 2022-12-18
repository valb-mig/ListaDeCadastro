<?php
    namespace App\Controller\Pages;

    use App\Utils\View;
    use Core\Router;

    class Page
    {   
        private static function getHeader()
        {
            return View::renderViewContent('pages/current/header');
        }

        public static function getCurrentPage($title,$content)
        {
            return View::renderViewContent('pages/current/page',
            [
                'title'   => $title,
                
                'header'  => self::getHeader(), 

                'content' => $content,

                'footer'  => self::getFooter(),
            ]);
        }

        private static function getFooter()
        {
            return View::renderViewContent('pages/current/footer');
        }
    }
