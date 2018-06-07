<?php

class pessoas{

    public function getPessoas(){

        $pdo = Database::Connect();

        $pdo = $pdo->prepare("SELECT * FROM tblpessoa");
        $pdo->execute();
        $result = json_encode($pdo->fetchAll());

        print_r($result);
    }

    public function getPessoa($id){


            $pdo = Database::Connect();

            $pdo = $pdo->prepare("SELECT * FROM tblpessoa WHERE pes_codigo= ?");
            $pdo->execute([$id]);
            $result = $pdo->fetchAll();

            print_r($result);

    }

    public function novaPessoa(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $pdo = Database::Connect();

            $params = [];
            $data = file_get_contents("php://input");
            $data = json_decode($data, true);

            try{

                if(!$data) 
                    throw new Exception('Falha ao receber POST!');
                
                
                foreach($data as $param){
                    $params[] = $param;
                }

                $pdo = $pdo->prepare("INSERT INTO tblpessoa(
                        pes_codigo, pes_nome_civil, pes_nome_funcional, pes_cpf, pes_rg, pes_identidade_funcional, pes_nascimento, pes_sexo, pes_dt_ingresso,
                        pes_nomeacao, pes_tipo_sanguineo, pes_estado_civil, pes_endereco, pes_cep, pes_fone_1, pes_fone_2, pes_cnh,
                        pes_cat_cnh, pes_venc_cnh, org_codigo, pos_codigo, cid_codigo
                    ) VALUES(
                        ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
                    )");

                $result = $pdo->execute($params);           
                
                if(!$result)    
                    throw new Exception('Falha ao criar recurso!');

            }catch( Exception $e ) {

                header($_SERVER["SERVER_PROTOCOL"]." 500 ". $e->getMessage());
                exit();

            }
            
        }

    }

    public function deletePessoa(){

    }

}