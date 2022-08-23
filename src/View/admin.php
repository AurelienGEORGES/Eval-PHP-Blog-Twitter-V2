<?php

namespace App\View;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use App\database\Database;

//CONNEXION A LA BASE DE DONNEES
$db = new Database();
$db->Connect();

?>

<!--PAGE D AFFICHAGE DES STATUS-->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>

    <main>
        <!--HEADER DU RESEAU SOCIAL-->
        <header>
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <div class="me-3">
                        <img src="CSS/twitter.png" width="80px" />
                    </div>
                    <div>
                        <a class="navbar-brand text-primary" href="?page=status">Accueil</a>
                    </div>
                </div>
            </nav>
        </header>

        <section class="w-100 d-flex align-items-center flex-column mt-3 mb-3">
            <!--BOUCLE POUR AFFICHER LES STATUT-->
            <?php foreach ($status as $statu) : ?>

                <div class="card my-3" style="width: 20rem; height: 20rem;">

                    <div class="card-body">
                        <h5 class="card-title"><?= $statu->getTitre_Status() ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $statu->getAuteur_Status() ?></h6>
                        <p class="card-text"><?= $statu->getContent_Status() ?></p>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $statu->getDate_Status() ?></h6>
                        <ul class="nav d-flex justify-content-center">
                            <li class="btn btn-outline-primary mx-2 my-2"><a class="text-decoration-none" href="?page=adminDelete&id=<?= $statu->getId() ?>">Supprimer</a></li>
                            <li class="btn btn-outline-primary mx-2 my-2"><a class="text-decoration-none" href="?page=adminCloture&id=<?= $statu->getId() ?>">Cloturer</a></li>
                        </ul>
                    </div>
                </div>
            <?php endforeach ?>
        </section>


    </main>

</body>

</html>