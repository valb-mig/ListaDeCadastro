<?php
    namespace App\Controller\Pages;

    use App\Model\Entity\Organization;
    use App\Utils\View;

    class Login extends Page
    {   
        public static function getIndex()
        {
            $organizationValues = new Organization;

            $content =  View::renderViewContent('pages/login',[
                'id'          => $organizationValues->id,
                'page'        => 'Login',
                'description' => 'Página de login',
            ]);

            return parent::getCurrentPage('👤 Login',$content);
        }
    }
