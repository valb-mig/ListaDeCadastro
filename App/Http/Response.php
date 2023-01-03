<?php
    namespace App\Http;

    class Response
    {
        private $httpCode       = 200;
        private $headers        = [];
        private $contentType    = 'text/html'; // Tipo de conteudo que será retornado
        private $resposeContent;
        
        public function __construct($httpCode,$resposeContent,$contentType = 'text/html')
        {
            $this->httpCode       = $httpCode;
            $this->resposeContent = $resposeContent;

            $this->setContentType($contentType);
        }

        public function setContentType($contentType)
        {
            $this->contentType = $contentType;
            $this->addHeader('Content-Type',$contentType);
        }

        public function addHeader($key,$value)
        {
            $this->headers[$key] = $value;
        }

        public function sendResponse() // Enviar a resposta para o usuário
        {
            // Enviar os headers para o navegador
            
            $this->sendHeaders();

            // Mostrar o conteúdo

            switch($this->contentType)
            {
                case 'text/html';
                echo $this->resposeContent;
                    break;
            }
        }

        private function sendHeaders()
        {
            // Setar status

            http_response_code($this->httpCode);

            // Enviar os headers para o navegador

            foreach($this->headers as $key=>$value)
            {
                header($key.' : '.$value);
            }
        }
    }
