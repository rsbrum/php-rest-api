<?php   

    /**
     * Bootstraps the application
     */
    function __autoload($classname) {
        
        $path = './core/' . $classname . '.php';
    
        if(file_exists($path)){
    
            require_once $path;
    
        }

    }

    $app = new Api();

