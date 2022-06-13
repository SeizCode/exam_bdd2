<?php

// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['nom']) and !empty($_POST['nom'])
    and isset($_POST['description']) and !empty($_POST['description'])
    and isset($_POST['lien']) and !empty($_POST['lien'])
    and isset($_POST['image']) and !empty($_POST['image'])){

        // On inclut la connexion à la base
        require_once('../Administration/connect.php');

        // On nettoie les données envoyées
        $nom = strip_tags($_POST['nom']);
        $description = strip_tags($_POST['description']);
        $lien = strip_tags($_POST['lien']);
        $image = strip_tags($_POST['image']);

        $sql = 'INSERT INTO `video`(`nom_video`, `description_video`, `lien_video`, `image_video`) VALUES (:nom_video, :description_video, :lien_video, :image_video)';

        $query = $db->prepare($sql);
        
        $query->execute([
            ':nom_video' => $nom,
            ':description_video' => $description,
            ':lien_video' => $lien,
            ':image_video' => $image
        ]);

        $_SESSION['message'] = "Vidéo ajouté";
        require_once('../Administration/close.php');

        header('Location: ../Administration/admin.php');
    

        }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }

}

?>