<?php
    namespace App\Controller\Pages;

    use App\Model\Entity\Organization;
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
            $organizationValues = new Organization;

            return View::renderViewContent('pages/current/page',
            [
                'title'   => $title,
                
                'header'  => self::getHeader(), 

                'content' => $content,

                'footer'  => self::getFooter(),

                'site'    => $organizationValues->site,
            ]);
        }

        private static function getFooter()
        {
            return View::renderViewContent('pages/current/footer');
        }
    }
