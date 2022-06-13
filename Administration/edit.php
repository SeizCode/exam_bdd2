<?php

// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['id']) and !empty($_POST['id'])
    and isset($_POST['nom']) and !empty($_POST['nom'])
    and isset($_POST['description']) and !empty($_POST['description'])
    and isset($_POST['lien']) and !empty($_POST['lien'])
    and isset($_POST['image']) and !empty($_POST['image'])){

        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
        $id = strip_tags($_POST['id']);
        $nom = strip_tags($_POST['nom']);
        $description = strip_tags($_POST['description']);
        $lien = strip_tags($_POST['lien']);
        $image = strip_tags($_POST['image']);

        $sql = 'UPDATE `video` SET `nom_video`=:nom, `description_video`=:description, `lien_video`=:lien, `image_video`=:image WHERE `id_video`=:id';

        $query = $db->prepare($sql);

        $query->bindValue(':id' , $id, PDO::PARAM_INT);
        $query->bindValue(':nom' , $nom, PDO::PARAM_STR);
        $query->bindValue(':description' , $description, PDO::PARAM_STR);
        $query->bindValue(':lien' , $lien, PDO::PARAM_INT);
        $query->bindValue(':image' , $image, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Vidéo modifié";
        require_once('close.php');

        header('Location: admin.php');
    

        }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }

}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

// On nettoie l'id envoyée
$id = strip_tags($_GET['id']);

$sql = "SELECT * FROM `video` WHERE `id_video` = :id;";

// On prépare la requête
$query = $db->prepare($sql);

// On "accroche" les paramétres (id)
$query->bindValue(':id', $id, PDO::PARAM_INT);

// On exécute la requête
$query->execute();

// On récupère le produit
$video = $query->fetch();

// On vérifie si le produit existe
if(!$video){
    $_SESSION['erreur'] = "Cet id n'existe pas";
    header('Location: ../admin.php');
}

} else{
    $_SESSION['Erreur'] = "URL invalide";
    header('Location: ../admin.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifié un projet</title>
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

                <h1>Modifié une vidéo</h1>
                <a href="../index.php">retour à l'accueil</a>
                <form method="post">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" value="<?= $video['nom_video']?>">

                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" class="form-control" value="<?= $video['description_video']?>">


                    </div>
                    <div class="form-group">
                        <label for="lien">Lien</label>
                        <input type="text" id="lien" name="lien" class="form-control" value="<?= $video['lien_video']?>">


                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="text" id="image" name="image" class="form-control" value="<?= $video['image_video']?>">


                    </div>

                        <input type="hidden" value="<?= $video['id_video']?>" name="id">
                        <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>

    </main>

    
</body>
</html>
