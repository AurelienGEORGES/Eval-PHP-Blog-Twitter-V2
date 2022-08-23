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

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Twitter | Status</title>
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

        <!-----------AFFICHAGE DU STATUS------------------------------------>
        <section class="w-100 d-flex align-items-center flex-column mt-3 mb-3">
            <div class="card my-3" style="width: 20rem; height: 20rem;">

                <div class="card-body">
                    <a href="?page=comment&id=<?= $status->getId() ?>" class="text-decoration-none">
                        <h5 class="card-title"><?= $status->getTitre_Status() ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $status->getAuteur_Status() ?></h6>
                        <p class="card-text"><?= $status->getContent_Status() ?></p>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $status->getDate_Status() ?></h6>
                    </a>
                </div>

            </div>
        </section>

        <!--FORMULAIRE D'AJOUT D'UN COMMENTAIRE-->
        <?php if ($status->getCloturer() === "non" || $status->getCloturer() === NULL) { ?>

            <section class="w-100 d-flex align-items-center flex-column mt-3 mb-3">
                <form action="?page=createComment&id=<?= $status->getId() ?>" method="post" class="formPost">
                    <div class="mb-3">
                        <label for="Input1" class="form-label">Auteur</label>
                        <input name="auteurComment" type="text" class="form-control" id="Input1" placeholder="pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="Textarea1" class="form-label">Contenu</label>
                        <textarea name="contenuComment" class="form-control" id="Textarea1" rows="5" placeholder="entrez du texte" required></textarea>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-outline-primary" type="submit">Commenter</button>
                    </div>
                </form>
            </section>

        <?php } ?>

        <!--------BOUCLE POUR AFFICHER LES COMMENTAIRES------>
        <section class="w-100 d-flex align-items-center flex-column mt-3 mb-3">

            <?php foreach ($comments as $comment) : ?>

                <div class="card my-3" style="width: 20rem; height: 20rem;">

                    <div class="card-body">
                        <a href="?page=comment&id=<?= $comment->getId() ?>" class="text-decoration-none">
                            <h6 class="card-subtitle mb-2 text-muted"><?= $comment->getAuteur_Comment() ?></h6>
                            <p class="card-text"><?= $comment->getContent_Comment() ?></p>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $comment->getDate_Comment() ?></h6>
                        </a>
                    </div>

                </div>

            <?php endforeach ?>

        </section>

    </main>

</body>

</html>