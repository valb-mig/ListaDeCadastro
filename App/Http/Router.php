<?php
    namespace App\Http;

    use \Closure;
    use \Exception;
    use \ReflectionFunction;

    class Router
    {
        private $url    = ''; // Url completa
        private $prefix = '';
        private $routes = []; // Indices de rotas
        private $request;

        public function __construct($url)
        {
            $this->request = new Request();
            $this->url     = $url;
            $this->setPrefix();
        } 

        private function setPrefix()
        {
            $parseUrl = parse_url($this->url);
            $this->prefix = $parseUrl['path'] ?? '';
        }

        private function addRoute($method,$route,$params = [])
        {
            // Validação parametros

            foreach($params as $key=>$value)
            {
                if($value instanceof Closure)
                {
                    $params['controller'] = $value;
                    unset($params[$key]);
                    continue;
                }
            }

            // Variáveis da rota
            $params['vars'] = [];

            $patternVars = '/{(.*?)}/';

            if(preg_match_all($patternVars,$route,$matches))
            {
                $route = preg_replace($patternVars,'(.*?)',$route);
                $params['vars'] = $matches[1];
            }

            // Padrão de validação (REGEX)
            
            $patternRoute = '/^'.str_replace('/','\/',$route).'$/';

            // Adicionando a rota

            $this->routes[$patternRoute][$method] = $params;
        }

        private function getUri()
        {
            $uri     = $this->request->getUri();
            $chopUri = strlen($this->prefix) ? explode($this->prefix,$uri) : [$uri];     
            
            return end($chopUri);
        }

        private function getRoute() // Retorna os dados da rota atual
        {
            $uri = $this->getUri();

            $httpMethod = $this->request->getHttpMethod();

            foreach($this->routes as $patternRoutes=>$methods)
            {
                if(preg_match($patternRoutes,$uri,$matches)) // Verifica se a uri se encontra no padrão
                {
                    if(isset($methods[$httpMethod])) // Verifica se o metodo existe
                    {
                        unset($matches[0]);

                        $keys = $methods[$httpMethod]['vars'];
                        $methods[$httpMethod]['vars'] = array_combine($keys,$matches);
                        $methods[$httpMethod]['vars']['request'] = $this->request;

                        return $methods[$httpMethod];
                    }
                    throw new Exception("Metodo não permitido",405);
                }
            }

            // Not found :/

            throw new Exception("Não Encontrado :/",404);
        }

        public function get($route,$params = [])
        {
            // Definir rota GET
            return $this->addRoute('GET',$route,$params);
        }

        public function post($route,$params = [])
        {
            // Definir rota POST
            return $this->addRoute('POST',$route,$params);
        }

        public function put($route,$params = [])
        {
            // Definir rota PUT
            return $this->addRoute('PUT',$route,$params);
        }

        public function delete($route,$params = [])
        {
            // Definir rota DELETE
            return $this->addRoute('DELETE',$route,$params);
        }

        public function run() // Executar a rota
        {
            try
            {
                $route = $this->getRoute();

                // Procurar controller

                if(!isset($route['controller']))
                {
                    throw new Exception('A Url não pode ser processada',500);
                }

                $args = [];

                $reflection = new ReflectionFunction($route['controller']);
                
                foreach($reflection->getParameters() as $parameter)
                {
                    $name = $parameter->getName();
                    $args[$name] = $route['vars'][$name] ?? '';
                }

                return call_user_func_array($route['controller'],$args);

            }catch(Exception $err)
            {
                return new Response($err->getCode(),$err->getMessage());
            }
        }
    }
