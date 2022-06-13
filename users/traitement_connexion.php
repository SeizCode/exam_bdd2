<?php
// On démarre une sesion et on connecte la bdd
session_start();
include '../Administration/connect.php';

// On verifie que le formulaire est pas vide est
if (!empty($_POST)){

    //On verifie que le champ mot de passe et mail ne soit pas vide
    if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])){

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            header ('location: ../connexion.php6'); // Vérification pour le mail
        } else{
            $sql = "SELECT * FROM users WHERE email_users = :email";
            $stmt = $db->prepare($sql);
            $result = $stmt->execute(array(
                ":email" => $_POST["email"]
            ));
            $membres = $stmt->fetch();

            if (!$membres){
                header('Location:../connexion.php');
            }
            else{
                // si l'utilisateur existe on verifie son mot de passe
                if (!password_verify($_POST["password"], $membres["mdp_users"])){
                  header('Location:../connexion.php');
                }
                else{
                    $_SESSION["membres"] = [
                        "id" => $membres["id_users"],
                        "nom" => $membres["nom_users"],
                        "email" => $membres["email_users"],
                    ];
                   
                    header('location: ../index.php');
                }
            }
        }
    } else {
          header ('location: ../connexion.php');
    }
}
?>