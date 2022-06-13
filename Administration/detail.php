<?php
// On démarre une session
session_start();

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
    <title>Détail du produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
    <main class = "container">
        <div class="row">
            <section class="col-12">
                <h1>Détail du projet <?= $video['id_video'] ?></h1>
                <p>id:<?= $video['id_video'] ?></p>
                <p>nom:<?= $video['nom_video'] ?></p>
                <p>description:<?= $video['description_video'] ?></p>
                <p>lien:<?= $video['lien_video'] ?></p>
                <p>image:<?= $video['image_video'] ?></p>
                <p><a href = "admin.php">Retour</a> <a href="edit.php?id=<?=$video['id_video'] ?>">Modifier</a></p>

            </section>
        </div>
    </main>
    
</body>
</html>