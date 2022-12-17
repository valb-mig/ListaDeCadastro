<?php
    namespace App\Utils;

    class View
    {
        public static function renderViewContent($view)
        {
            $contentView = View::getViewContent($view);

            return $contentView;
        }

        private static function getViewContent($view)
        {
            $file = __DIR__.'/../../resources/view/'.$view.'.phtml';

            return isset($file) && !empty($file) ? file_get_contents($file) : '';
        }
    }