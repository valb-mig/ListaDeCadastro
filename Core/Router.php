<?php
    namespace Core;

    use \App\Controller\Pages\Home;
    use \App\Controller\Pages\Login;
    use \App\Controller\Pages\Register;

    class Router
    {
        private static $controller;
        private static $method;
        private static $params = [];

        public static function routes()
        {
            // $url = Router::getUrl();
            
            // $controller = Router::$controller;
            // $method     = Router::$method;
            // $params     = Router::$params;

            // $controller = $url[0];
            // $method     = $url[1];

            // var_dump($controller);

            // // Retorno das paginas

            // if($url == 'Home')
            // {
            //     return Home::getIndex();
            // }

            return 'routes';
        }

        public static function getUrl()
        {
            $url = explode('/',filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL));
            return $url;
        }
    }
