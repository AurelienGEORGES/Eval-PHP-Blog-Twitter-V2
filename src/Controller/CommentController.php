<?php

namespace App\Controller;

use App\Model\StatusModel;
use App\Model\CommentModel; 
use App\Controller\AbstractController;

class CommentController extends AbstractController
{
    public function index()
    {   
        $id = $_GET['id'];
        
        $statusModel = new StatusModel();
        $commentModel = new CommentModel();

        $comments = $commentModel->findByStatus($id);
        $status = $statusModel->findById($id);

        $this->render('comment.php', [
            'comments' => $comments,
            'status' => $status
        ]);
    }

    //FONCTION QUI CREE UN COMMENTAIRE
    public function create()
    {

        //ON RECUPERE LES DONNEES DU FORMULAIRE DE COMMENTAIRE PAR LA METHODE POST
        $Auteur_Comment = $_POST['auteurComment'];
        $Content_Comment = $_POST['contenuComment'];
        //ON RECUPERE LES ID PAR LA METHODE GET
        if (isset($_GET['id'])) {
        $id = $_GET['id'];
        }
        if (!empty($Auteur_Comment)) {
            
            $commentModel = new commentModel();
            $statusModel = new statusModel();
            $commentModel->create($Auteur_Comment, $Content_Comment, $id);
            $statusModel->update($id);
            $comments = $commentModel->findByStatus($id);
            $status = $statusModel->findById($id);
               

        $this->render('comment.php', [
            'comments' => $comments,
            'status' => $status
        ]);
        }
    }
}

