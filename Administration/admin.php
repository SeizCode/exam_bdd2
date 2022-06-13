<?php

// On démarre une session
session_start();


// On inclut la connexion à la base de data

require_once('connect.php');

$sql = "SELECT * FROM `video`";

// On prépare la requête

$query = $db->prepare($sql);

// On exécute la requête

$query->execute();

// On stocke le résultat dans un tableau associatif

$result = $query->fetchall(PDO::FETCH_ASSOC);

require_once('close.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des video</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>

    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['Erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                        ' . $_SESSION['erreur'].'
                        </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                                <?php
                    if(!empty($_SESSION['message'])){
                        echo '<div class="alert alert-success" role="alert">
                        ' . $_SESSION['message'].'
                        </div>';
                        $_SESSION['message'] = "";
                    }
                ?>

                <h1>Liste des projets</h1>
                <a href="../index.php">retour à l'accueil</a>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>nom</th>
                        <th>description</th>
                        <th>lien</th>
                        <th>image</th>
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        foreach($result as $video) {
                            ?>
                                <tr>
                                    <td><?= $video['id_video'] ?></td>
                                    <td><?= $video['nom_video'] ?></td>
                                    <td><?= $video['description_video'] ?></td>
                                    <td><?= $video['lien_video'] ?></td>
                                    <td><?= $video['image_video'] ?></td>
                                    <td><a href="detail.php?id=<?= $video['id_video']?>">Voir</a> <a href="edit.php?id=<?= $video['id_video']?>">Modifié</a> <a href="delete.php?id=<?=  $video['id_video']?>">Supprimer</a></td>
                                </tr>
                        <?php 
                        }
                        ?>

                    </tbody>
                </table>
                <a href="../ajouter.php" class="btn btn-primary">Ajouter une vidéo</a>

            </section>
        </div>

    </main>

    
</body>
</html>
