<?php 

class Api{

    private $controller;
    private $method;
    private $params = [];

    function __construct(){

        /**
         * Access control headers, it makes the code cleaner to declare them here
         * instead of declaring them inside every method
         */
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Credentials: true");
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

        $this->router();
        $path = Config::get("PATH_CONTROLLERS") . $this->controller . '.php';
        $method = $this->method;

        try{

            if(!file_exists($path))
                throw new Exception('Controlador nao existe');

            require_once $path;

            /*
            * Function parameters will be called respectively
            */ 
            if(!empty($this->params))
                call_user_func_array(array($this->controller, $this->method), $this->params);   

            else{
                
                $this->controller = new $this->controller;
                $this->controller->$method();  
            
            }

        }catch(Exception $e){

            header($_SERVER["SERVER_PROTOCOL"]." 500 ". $e->getMessage());
            exit();

        }
         
    }

    /**
     * Trims the URL and sets the controller and method to be executed by the controller
     * It doesn't have a default controller or method so an URL must be provided
     */
    public function router(){

        try{

            if(!isset($_GET['url']))
                throw new Exception('URI invalida');
           
            $url = explode('/', $_GET['url']);

            if(sizeof($url) < 2)
                throw new Exception('URI invalida');

            else{

                $this->controller = $url[0];
                $this->method = $url[1];

                //If a parameter one or more parameter is provided in the URL, it will be put into the params array
                for($i = 2; $i < sizeof($url); $i++)
                    $this->params[] = $url[$i];

           }

        } catch(Exception $e){

            header($_SERVER["SERVER_PROTOCOL"]." 500 ". $e->getMessage());
            exit();

        }
           
    }

}