<?php
    use \App\Http\Response;
    use \App\Controller\Pages;

    // ROTA HOME

    $objRouter->get('/',[
        function()
        {
            return new Response(200,Pages\Home::getIndex());
        }
    ]);

    // ROTA LOGIN

    $objRouter->get('/login',[
        function()
        {
            return new Response(200,Pages\Login::getIndex());
        }
    ]);