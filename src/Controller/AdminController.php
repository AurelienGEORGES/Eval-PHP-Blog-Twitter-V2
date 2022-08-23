<?php

namespace App\Controller;

use App\Model\AdminModel;
use App\Model\StatusModel;
use App\Controller\AbstractController;

class AdminController extends AbstractController
{
    public function index()
    {
        $statusModel = new AdminModel();

        $status = $statusModel->findAll();
        
        $this->render('admin.php', [
            'status' => $status
        ]);
    }

    public function deleteAdmin()
    {
        //ON RECUPERE L'ID DU POST A SUPPRIMER'
        $id = $_GET['id'];
        
        $adminModel = new AdminModel();
        $statusModel = new StatusModel();
        
        //SUPPRESSION DU POST SOUHAITE
        
        $adminModel->deleteAdmin($id);

        $status = $statusModel->findAll();
        
        $this->render('admin.php', [
            'status' => $status
        ]);
    }

    public function clotureAdmin()
    {
        //ON RECUPERE L'ID DU POST A CLOTURER
        $id = $_GET['id'];
        
        $adminModel = new AdminModel();
        $statusModel = new StatusModel();
        
        //CLOTURE DU POST SOUHAITE
        $adminModel->clotureAdmin($id);

        $status = $statusModel->findAll();
        
        $this->render('admin.php', [
            'status' => $status
        ]);
    }
}