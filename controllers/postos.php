<?php 

class postos{

    public function getPostos(){

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $pdo = Database::Connect();

            $pdo = $pdo->prepare("SELECT * FROM tblposto");
            $pdo->execute();
            $result = json_encode($pdo->fetchAll());

            print_r($result);
            
        }

    }

    public function novoPosto(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $params = [];
            $pdo = Database::Connect();
            $data = file_get_contents("php://input");
            $data = json_decode($data, true);  
            
            try{

                if(empty($data))
                    throw new Exception('Falha ao receber POST!');

                foreach($data as $param){
                    $params[] = $param;
                }

                if(!empty($params)){
                    $pdo = $pdo->prepare("INSERT INTO tblposto VALUES(?,?,?)");
                    $pdo->execute($params);
                }  

            } catch( Excpetion $e ){

                header($_SERVER["SERVER_PROTOCOL"]." 500 ". $e->getMessage());
                exit();

            } 
             
        }
 
    }

}