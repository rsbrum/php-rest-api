<?php

class example{

    /*
    * Post example, throws if post body is empty
    */
    function post(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $params = [];
            $pdo = Database::Connect();
            $data = file_get_contents("php://input");
            $data = json_decode($data, true);  
    
            try{

                if(empty($data))
                    throw new Exception('Falha ao receber POST!');

                /**
                 * Extracts data from json object and makes the code cleaner
                 * but you have to insert data into the database respectively 
                 */
                foreach($data as $param){
                    $params[] = $param;
                }
            
                if(!empty($params)){
                    $pdo = $pdo->prepare("INSERT INTO example VALUES(?,?,?)");
                    $pdo->execute($params);
                }   

            } catch( Excpetion $e ){

                header($_SERVER["SERVER_PROTOCOL"]." 500 ". $e->getMessage());
                exit();

            }
        }
    }
    
    /**
     * Get request example 
     */
    function get(){

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            
            $pdo = Database::Connect();

            $pdo = $pdo->prepare("SELECT * FROM example");
            $pdo->execute();
            $result = json_encode($pdo->fetchAll());

            print_r($result);
        
        }

    }

    /*
    * ONLY base64 encoded files can be uploaded, in order to access the file it is necessary to trim 
    * the http body and remove everything that is not base64 code, usually it is separeted by a coma
    * '"data:image/jpeg;base64, base64code...' 
    */
    function fileUpload(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = file_get_contents("php://input");
            $data = base64_decode($data);

            file_put_contents(__DIR__.'uploads/image.png', $data);

        }

    }

}