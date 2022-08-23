<?php

namespace App\Model;

use PDO;
use App\database\Database;

//CLASSE QUI GERE: LA RECUPERATION DE TOUS LES STATUS POUR LEUR AFFICHAGE, 
//LEUR SUPPRESSION, LEUR CLOTURATION

class AdminModel
{
    protected $id;
    protected $pdo;

    const TABLE_NAME = 'Status_Table';


    //CONSTRUCTEUR
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPDO();
    }

    //FONCTION QUI RECUPERE TOUS LES STATUS EN BASE DE DONNEES
    public function findAll()
    {
        $sql = 'SELECT *
                FROM ' . self::TABLE_NAME . '
                ORDER BY `id` ASC;
        ';

        $pdoStatement = $this->pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        return $results;
    }

    //FONCTION QUI PERMET DE SUPPRIMER UN STATUS PAR L'ID
    public function deleteAdmin($id)
    {
        $sql = 'DELETE
                FROM ' . self::TABLE_NAME . '
                WHERE `id` = :id;
        ';

        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $results = $pdoStatement->execute();
        $results = $pdoStatement->fetchObject(self::class);
        return $results;
    }

    //FONCTION QUI PERMET DE CLOTURER UN STATUS PAR L'ID
    public function clotureAdmin($id)
    {
        $sql = 'UPDATE ' . self::TABLE_NAME . '
                SET cloturer = "oui"
                WHERE id = :id           
        ';

        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $results = $pdoStatement->execute();
        $results = $pdoStatement->fetchObject(self::class);
        return $results;
    }

    //GETTER ID 
    public function getId()
        {
        return $this->id;
        }

    //GETTER DE LA DATE DU STATUS 
    public function getDate_Status()
        {
            return $this->Date_Status;
        }

    //GETTER DU CONTENU DU STATUS 
    public function getContent_Status()
    {
        return $this->Content_Status;
    }

    //GETTER DU TITRE DU STATUS 
    public function getTitre_Status()
    {
        return $this->Titre_Status;
    }

    //GETTER DE L AUTEUR DU STATUS 
    public function getAuteur_Status()
    {
        return $this->Auteur_Status;
    }

    

}
