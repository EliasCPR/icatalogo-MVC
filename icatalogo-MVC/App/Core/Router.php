<?php

    namespace App\Core;

    Class Router{

        private $controller;

        private $method = "index";

        private $params;

        function __construct(){
        //recuperar a URL que esta sendo acessada
            $url = $this->parseURL();
            
            //se controller existir dentro da pasta de controller
            if(isset($url[1]) && file_exists("../App/Controller/". $url[1] . ".php")){
                $this->controller = $url[1];

                unset($url[1]);

            }elseif(empty($url[1])){

                //setamos o controller padrão da aplicação
                $this->controller = "produtos";
            }else{
                /*Se não existir ou ouver um controller na url
                exibimos página não encintrada*/ 

                print_r($url);

                $this->controller = "erro404";
            }
            //importamos o controller
            require_once "../App/Controller/" . $this->controller . ".php";
            //instanciamos o controller
            $this->controller = new $this->controller;
            //aribuimos ao atributo method
            if(isset($url[2])){
                if (method_exists($this->controller, $url[2])){
                    $this->method = $url[2];
                    unset($url[2]);
                    unset($url[0]);
                }
            }

            //pegamos o parametro da url
            $this->params = $url ? array_values($url) : [];

            var_dump($this->method);
            //executamos o método dentro do controller, passando os parametros
            call_user_func_array([$this->controller, $this->method], $this->params);
        }

        //recuperar a URL e recuperar os parametros
        private function parseURL(){
           return explode("/",$_SERVER["SERVER_NAME"]. $_SERVER["REQUEST_URI"]);
        }
    }