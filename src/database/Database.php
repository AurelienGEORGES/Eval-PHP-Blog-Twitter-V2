<?php

namespace App\database;

use PDOException;
use PDO;

//CLASSE DE CONNEXION A LA BASE DE DONNEES
class Database
{   
    private $config;
    private $pdo;

    //CONSTRUCTEUR
    public function __construct()
    {
        $this->getconfig();
        $this->connect();
    }

    //RECUPERATION 
    private function getconfig()
    {
        $config = parse_ini_file('config.ini', true);

        if (!$config) {
            throw new \Exception("Le fichier config.ini n'existe pas");
        }

        $this->config = $config;
    }

    //FONCTION POUR SE CONNECTER A LA BASE DE DONNEES
    public function connect()
    {
        $db ='';
        
        try {
            $db = new PDO('mysql:host=' . $this->config["DB_HOST"] . ';dbname=' . $this->config["DB_NAME"], $this->config["DB_USERNAME"], $this->config["DB_PASSWORD"]);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Échec lors de la connexion : ' . $e->getMessage();
        }

        $this->pdo = $db;
    }

    //FONCTION GETTER POUR RECUPERER LA PDO
    public function getPDO()
    {
        return $this->pdo;
    }
}
