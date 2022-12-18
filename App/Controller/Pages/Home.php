<?php
    namespace App\Controller\Pages;

    use App\Model\Entity\Organization;
    use App\Utils\View;

    class Home extends Page
    {   
        public static function getIndex()
        {
            $organizationValues = new Organization;

            $content =  View::renderViewContent('pages/home',[
                'id'          => $organizationValues->id,
                'page'        => 'Home',
                'description' => 'Pagina da home',
                'about'       => $organizationValues->about, 
            ]);

            return parent::getCurrentPage('Home',$content);
        }
    }
