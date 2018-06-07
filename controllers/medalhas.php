<?php 

 class medalhas{

    public function getMedalhas(){

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            
            $pdo = Database::Connect();

            $pdo = $pdo->prepare("SELECT * FROM tblmedalha");
            $pdo->execute();
            $result = json_encode($pdo->fetchAll());

            print_r($result);
        
        }
    }
    
    public function novaMedalha(){

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
                    $pdo = $pdo->prepare("INSERT INTO tblmedalha VALUES(?,?,?)");
                    $pdo->execute($params);
                }   

            } catch( Excpetion $e ){

                header($_SERVER["SERVER_PROTOCOL"]." 500 ". $e->getMessage());
                exit();

            }
        }

    }

    public function concederMedalha(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $params = [];
            $pdo = Database::Connect();
            $data = file_get_contents("php://input");
            $data = json_decode($data, true);  
            var_dump($data);
            try {
                
                if(empty($data))
                    throw new Exception('Falha ao receber POST!');

                foreach($data as $param){
                    $params[] = $param;
                }

                if(!empty($params)){

                    $pdo = $pdo->prepare("INSERT INTO tblconcessaomedalha VALUES(?,?,?)");
                    $pdo->execute($params);

                }

            } catch( Exception $e){
                echo $e->getMessage();
                header($_SERVER["SERVER_PROTOCOL"]." 500 ". $e->getMessage());
                exit();

            }
                 
        }

    }

    public function getPessoasMedalhas(){
        
        if($_SERVER['REQUEST_METHOD'] === 'GET') {

            $pdo = Database::Connect();

            $pdo = $pdo->prepare("SELECT tblmedalha.med_descricao, tblpessoa.pes_nome_civil, tblconcessaomedalha.cme_data 
            FROM tblconcessaomedalha 
            JOIN tblpessoa 
            ON tblpessoa.pes_codigo=tblconcessaomedalha.pes_codigo 
            JOIN tblmedalha
            ON tblconcessaomedalha.med_codigo=tblmedalha.med_codigo");
            $pdo->execute();
            $result = json_encode($pdo->fetchAll());
    
            print_r($result);

        }
        
    }

 }