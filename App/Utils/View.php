<?php
    namespace App\Utils;

    class View
    {
        private static $vars = [];

        public static function init($vars = [])
        {
            self::$vars = $vars;
        }

        public static function renderViewContent($view, $vars = [])
        {
            $contentView = View::getViewContent($view);

            $vars = array_merge(self::$vars,$vars);

            $keys = array_keys($vars); 

            $keys = array_map(function($item){
                return '{{'.$item.'}}';
            }, $keys);

            return str_replace($keys,array_values($vars),$contentView);
        }

        private static function getViewContent($view)
        {
            $file = __DIR__.'/../../resources/view/'.$view.'.html';

            return isset($file) && !empty($file) ? file_get_contents($file) : '';
        }
    }