<?php

namespace App\Controller;

use App\Model\StatusModel;
use App\Controller\AbstractController;

class StatusController extends AbstractController
{
    public function index()
    {   
        $statusModel = new StatusModel();
        $statusrecup = $statusModel->findAll();

        //PAGINATION DEFINITION DES VARIABLES 
        $page = 1;

        if (isset($_GET["?p"])) {   
        $page = $_GET["?p"];
        }

        $nbr_status_par_pages = 5;
        $page_debut = ($page - 1)*$nbr_status_par_pages;
        $nbr_status = count($statusrecup);
        $nbr_de_pages = ceil($nbr_status/$nbr_status_par_pages);  

        //RECUPERATION DES STATUS AVEC PAGINATION

        $status = $statusModel->findAllByPagesPopularite($page_debut , $nbr_status_par_pages);
        
        $tri = 'status';
        
        $this->render('status.php', [
            'status' => $status,
            'nbr_de_pages' => $nbr_de_pages,
            'tri' => $tri,
            'page' => $page    
        ]);
    
    }

    
    public function create()
    {

        //ON RECUPERE LES DONNEES DU FORMULAIRE STATUS
        $Auteur_Status = $_POST['auteurStatus'];
        $Titre_Status = $_POST['titreStatus'];
        $Content_Status = $_POST['contenuStatus'];

        if (!empty($Auteur_Status)) {
            
            $statusModel = new StatusModel();
            $statusModel->create($Auteur_Status, $Titre_Status, $Content_Status);
            $status = $statusModel->findAll();
        }

        $statusrecup = $statusModel->findAll();

        //PAGINATION DEFINITION DES VARIABLES 
        $page = 1;

        if (isset($_GET["?p"])) {   
        $page = $_GET["?p"];
        }

        $nbr_status_par_pages = 5;
        $page_debut = ($page - 1)*$nbr_status_par_pages;
        $nbr_status = count($statusrecup);
        $nbr_de_pages = ceil($nbr_status/$nbr_status_par_pages);  

        //RECUPERATION DES STATUS AVEC PAGINATION
        $status = $statusModel->findAllByPagesPopularite($page_debut , $nbr_status_par_pages);

        $tri = 'status';

        $this->render('status.php', [
            'status' => $status,
            'nbr_de_pages' => $nbr_de_pages,
            'tri' => $tri,
            'page' => $page
        ]);
    }

    public function triTitre()
    {
        $Titre_Status = $_POST['rechercheTitre'];

        if (!empty($Titre_Status)) {

            $statusModel = new StatusModel();
            
        } 

        //RECUPERATION DES STATUS AVEC PAGINATION
        $status = $statusModel->triTitre($Titre_Status);

        $tri = 'titre';

        $this->render('status.php', [
            'status' => $status,
            'tri' => $tri
        ]);
    }

    public function triHashTag()
    {
        $Content_Status = $_POST['rechercheHashTag'];

        if (!empty($Content_Status)) {

            $statusModel = new StatusModel();
            
        }

        $status = $statusModel->triHashTag($Content_Status);

        $tri = 'HashTag';

        $this->render('status.php', [
            'status' => $status,
            'tri' => $tri
        ]);
    }

    //FONCTION QUI REALISE LE TRI ASCENDANT
    public function triAscendant()
    {
        
        $statusModel = new StatusModel();

        $statusrecup = $statusModel->findAll();

        //PAGINATION DEFINITION DES VARIABLES 
        $page = 1;

        if (isset($_GET["?p"])) {   
        $page = $_GET["?p"];
        }

        $nbr_status_par_pages = 5;
        $page_debut = ($page - 1)*$nbr_status_par_pages;
        $nbr_status = count($statusrecup);
        $nbr_de_pages = ceil($nbr_status/$nbr_status_par_pages);  

        //RECUPERATION DES STATUS AVEC PAGINATION
        $status = $statusModel->findAllByPagesAscendant($page_debut , $nbr_status_par_pages);

        $tri = 'triAscendant';

        $this->render('status.php', [
            'status' => $status,
            'nbr_de_pages' => $nbr_de_pages,
            'tri' => $tri,
            'page' => $page
        ]);
    }

    //FONCTION QUI REALISE LE TRI DESCENDANT
    public function triDescendant()
    {
        
        $statusModel = new StatusModel();
        //$status = $statusModel->triDescendant();
        
        $statusrecup = $statusModel->triDescendant();

        //PAGINATION DEFINITION DES VARIABLES 
        $page = 1;

        if (isset($_GET["?p"])) {   
        $page = $_GET["?p"];
        }

        $nbr_status_par_pages = 5;
        $page_debut = ($page - 1)*$nbr_status_par_pages;
        $nbr_status = count($statusrecup);
        $nbr_de_pages = ceil($nbr_status/$nbr_status_par_pages);  

        //RECUPERATION DES STATUS AVEC PAGINATION
        
        $status = $statusModel->triDescendant();
        $status = $statusModel->findAllByPagesDescendant($page_debut , $nbr_status_par_pages);

        $tri = 'triDescendant';

        $this->render('status.php', [
            'status' => $status,
            'nbr_de_pages' => $nbr_de_pages,
            'tri' => $tri,
            'page' => $page
        ]);
    }

    //FONCTION QUI REALISE LE TRI PAR POPULARITE
    public function triPopularite()
    {

        $statusModel = new StatusModel();
        $status = $statusModel->triPopularite();
        
        $statusrecup = $statusModel->triPopularite();

        //PAGINATION DEFINITION DES VARIABLES 
        $page = 1;

        if (isset($_GET["?p"])) {   
        $page = $_GET["?p"];
        }

        $nbr_status_par_pages = 5;
        $page_debut = ($page - 1)*$nbr_status_par_pages;
        $nbr_status = count($statusrecup);
        $nbr_de_pages = ceil($nbr_status/$nbr_status_par_pages);  

        //RECUPERATION DES STATUS AVEC PAGINATION
        $status = $statusModel->findAllByPagesPopularite($page_debut , $nbr_status_par_pages);

        $tri = 'triPopularite';

        $this->render('status.php', [
            'status' => $status,
            'nbr_de_pages' => $nbr_de_pages,
            'tri' => $tri,
            'page' => $page
        ]);
    }

    
}
