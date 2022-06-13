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
    header('Location: admin.php');
    die();
}

$sql = "DELETE FROM `video` WHERE `id_video` = :id;";

// On prépare la requête
$query = $db->prepare($sql);

// On "accroche" les paramétres (id)
$query->bindValue(':id', $id, PDO::PARAM_INT);

// On exécute la requête
$query->execute();
$_SESSION['message'] = "Projets supprimé";
header('Location: admin.php');



} else{
    $_SESSION['Erreur'] = "URL invalide";
    header('Location: admin.php');
}
?>
