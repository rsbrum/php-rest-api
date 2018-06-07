<?php   

class orgaos{

    public function getOrgaos(){

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $pdo = Database::Connect();

            $pdo = $pdo->prepare("SELECT * FROM tblorgao");
            $pdo->execute();
            $result = json_encode($pdo->fetchAll());

            print_r($result);

        }

    }
    
    public function novoOrgao(){

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
                    $pdo = $pdo->prepare("INSERT INTO tblorgao VALUES(?,?,?,?)");
                    $pdo->execute($params);
                }   

            } catch( Excpetion $e ){

                header($_SERVER["SERVER_PROTOCOL"]." 500 ". $e->getMessage());
                exit();

            }  
            
        }
        
    }

}