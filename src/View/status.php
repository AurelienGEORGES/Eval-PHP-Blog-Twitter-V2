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
    <title>Social Network</title>
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
                        <a class="navbar-brand text-primary" href="?page=admin">Admin</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Tri
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="?page=triPopularite">Popularité</a></li>
                                    <li><a class="dropdown-item" href="?page=triAscendant">Ascendant</a></li>
                                    <li><a class="dropdown-item" href="?page=triDescendant">Descendant</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="d-flex" role="search" action="?page=triTitre" method="post">
                            <input name="rechercheTitre" class="form-control me-2" type="search" placeholder="entrez votre titre" aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit">recherche par titre</button>
                        </form>
                        <form class="d-flex ms-2" role="search" action="?page=triHashTag" method="post">
                            <input name="rechercheHashTag" class="form-control me-2" type="search" placeholder="entrez votre hashtag" aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit">recherche par #</button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>

        <!--FORMULAIRE D'AJOUT D'UN STATUS-->
        <section class="w-100 d-flex align-items-center flex-column mt-3 mb-3">
            <form action="?page=createStatus" method="post" class="formPost">
                <div class="mb-3">
                    <label for="Input1" class="form-label">Auteur</label>
                    <input name="auteurStatus" type="text" class="form-control" id="Input1" placeholder="pseudo" required>
                </div>
                <div class="mb-3">
                    <label for="Input2" class="form-label">Titre</label>
                    <input name="titreStatus" type="text" class="form-control" id="Input2" placeholder="titre du post" required>
                </div>
                <div class="mb-3">
                    <label for="Textarea1" class="form-label">Contenu</label>
                    <textarea name="contenuStatus" class="form-control" id="Textarea1" rows="5" placeholder="entrez du texte" required></textarea>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-outline-primary" type="submit">Postez</button>
                </div>
            </form>
        </section>

        <!----AFFICHAGE DES STATUS EN COURS---------->
        <section class="d-flex align-items-center flex-column">

            <!--PAGINATION-->

            <?php if ($tri === 'status' || $tri === 'triAscendant' || $tri === 'triDescendant' || $tri === 'triPopularite') { ?>
                <div class="d-flex align-items-center flex-row">

                    <?php for ($i = 1; $i <= $nbr_de_pages; $i++) { ?>

                        <ul class="pagination ">

                            <?php if ($i == $page) { ?>

                                <li class="page-item active mx-2"><a class="page-link" href="?page=<?= $tri ?>&?p=<?= $i ?>"><?= $i ?></a></li>

                            <?php } else { ?>

                                <li class="page-item mx-2"><a class="page-link" href="?page=<?= $tri ?>&?p=<?= $i ?>"><?= $i ?></a></li>

                            <?php } ?>

                        </ul>

                    <?php } ?>

                </div>

            <?php } ?>

            <!--BOUCLE POUR AFFICHER LES STATUT-->
            <?php foreach ($status as $statu) : ?>

                <div class="card my-3" style="width: 20rem; height: 20rem;">

                    <div class="card-body">
                        <a href="?page=comment&id=<?= $statu->getId() ?>" class="text-decoration-none">
                            <h5 class="card-title"><?= $statu->getTitre_Status() ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $statu->getAuteur_Status() ?></h6>
                            <p class="card-text"><?= $statu->getContent_Status() ?></p>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $statu->getDate_Status() ?></h6>
                        </a>
                    </div>

                </div>
            <?php endforeach ?>

        </section>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>