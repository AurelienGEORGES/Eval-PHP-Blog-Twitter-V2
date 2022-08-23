<?php

namespace App\Model;

use PDO;
use App\database\Database;

class CommentModel
{

    protected $id;
    protected $Auteur_Comment;
    protected $Content_Comment;
    protected $Date_Comment;
    protected $Id_Status;
    protected $pdo;

    const TABLE_NAME = 'Comment_Table';

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPDO();
    }

    //FONCTION QUI VA CHERCHER TOUS LES COMMENTAIRES EN BDD
    public function findAll()
    {
        $sql = 'SELECT
                `id`
                ,`Auteur_Comment`
                ,`Content_Comment`
                ,`Date_Comment`
                ,`Id_Status`
                FROM ' . self::TABLE_NAME . '
                ORDER BY `id` ASC;
        ';

        $pdoStatement = $this->pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        return $result;
    }

    //FONCTION QUI VA CHERCHER LES COMMENTAIRES D'UN STATUS PRECIS PAR SON STATUS_ID
    public function findByStatus($Id_Status)
    {
        $sql = 'SELECT
                `id`
                ,`Auteur_Comment`
                ,`Content_Comment`
                ,`Date_Comment`
                ,`Id_Status`
                FROM ' . self::TABLE_NAME . '
                WHERE `Id_Status` = :Id_Status
                ORDER BY `id` ASC;
        ';

        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->bindValue(':Id_Status', $Id_Status, PDO::PARAM_INT);
        $result = $pdoStatement->execute();
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        return $result;
    }

    public function create($Auteur_Comment, $Content_Comment, $Id_Status)
    {
        $sql = 'INSERT INTO ' . self::TABLE_NAME . '
        (`Auteur_Comment`,`Content_Comment`,`Date_Comment`,`Id_Status`)
        VALUES
        (:Auteur_Comment,:Content_Comment,NOW(),:Id_Status)
        ';

        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->bindValue(':Auteur_Comment', $Auteur_Comment, PDO::PARAM_STR);
        $pdoStatement->bindValue(':Content_Comment', $Content_Comment, PDO::PARAM_STR);
        $pdoStatement->bindValue(':Id_Status', $Id_Status, PDO::PARAM_INT);

        $result = $pdoStatement->execute();

        if (!$result) {
            return false;
        }

        return $this->pdo->lastInsertId();
    }

    

    //GETTER COMMENT ID
    public function getId()
    {
        return $this->id;
    }

    //SETTER COMMENT ID 
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    //GETTER COMMENT AUTEUR
    public function getAuteur_Comment()
    {
        return $this->Auteur_Comment;
    }

    //SETTER COMMENT AUTEUR
    public function setAuteur_Comment(String $Auteur_Comment)
    {
        $this->Auteur_Comment = $Auteur_Comment;
        return $this;
    }

    //GETTER COMMENT CONTENT
    public function getContent_Comment()
    {
        return $this->Content_Comment;
    }

    //SETTER COMMENT CONTENT
    public function setContent_Comment(int $Content_Comment)
    {
        $this->Content_Comment = $Content_Comment;
        return $this;
    }

    //GETTER ID DU STATUS CONTENANT TOUS LES COMMENTAIRES
    public function getId_Status()
    {
        return $this->Id_Status;
    }

    //SETTER ID DU STATUS CONTENANT TOUS LES COMMENTAIRES
    public function setId_Status(int $Id_Status)
    {
        $this->Id_Status = $Id_Status;
        return $this;
    }

    //GETTER DE LA DATE DU COMMENTAIRE
    public function getDate_Comment()
    {
        return $this->Date_Comment;
    }

    
}
