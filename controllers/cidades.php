<?php 

class cidades{

    public function getCidades(){

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                
            $pdo = Database::Connect();

            $pdo = $pdo->prepare("SELECT * FROM tblcidade");
            $pdo->execute();
            $result = json_encode($pdo->fetchAll());

            print_r($result);

        }

    }

    public function novaCidade(){
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $parametros = [];
            $pdo = Database::Connect();
            $data = file_get_contents("php://input");
            $data = json_decode($data, true);  

            try{
                
                if(empty($data))
                    throw new Excpetion('Falha ao acessar recurso!');

                foreach($data as $param){
                    $parametros[] = $param;
                }        

                if(!empty($parametros)){
                    $pdo = $pdo->prepare("INSERT INTO tblcidade VALUES(?,?,?)");
                    $pdo->execute($parametros); 
                }

            } catch( Exception $e){
                    
                header($_SERVER["SERVER_PROTOCOL"]." 500 ". $e->getMessage());
                exit();

            }
            
        }

    }

}