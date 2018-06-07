<?php

class Database{

    public static function Connect()
    {
        
        try {

            $pdo = new PDO('pgsql:host=localhost;dbname=' . Config::get("DB_NAME"), Config::get("DB_USER"), Config::get("DB_PASS"));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);     
            $pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );           
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
           
            return $pdo;

        } catch (PDOException $e) {
      
            die("Erro!: " . $e->getMessage() . "<br/>");
            exit();
        }

    }

}