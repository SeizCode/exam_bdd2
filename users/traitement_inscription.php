<?php include("../Administration/connect.php");

		 /* récupérer les données du formulaire en utilisant 
		    la valeur des attributs name comme clé
	     */
    
    if (isset($_POST))
    {
        if((isset($_POST['nom'])) && (!empty($_POST['nom']))){
            $nom = htmlspecialchars($_POST['nom']);
        }

        else{
            header('Location: ../inscription.php');
        }

        if((isset($_POST['prenom'])) && (!empty($_POST['prenom']))){
            $prenom = htmlspecialchars($_POST['prenom']);
        }

        else{
            header('Location: ../inscription.php');
        }

        if((isset($_POST['email'])) && (!empty($_POST['email']))){
            $mail = htmlspecialchars($_POST['email']);
        }
        else{
            header('Location: ../inscription.php');
        }
        if (isset($_POST['password']) && (!empty($_POST['password']))) {
            $password = htmlspecialchars($_POST['password']);
        }
        else{
            header('Location: ../inscription.php');
        }

     
    $stmt = $db->prepare("SELECT * FROM users WHERE nom_users= ? AND email_users = ?");
    $stmt->execute([$nom,$mail]); 
    $count_nom = $stmt->rowcount();
    
    $count_mail = $stmt->rowcount();
    if($count_nom==0){
        //cest bon il n'y a pas le pseudo en double
        if($count_mail==0){
            //C'est bon le mail n'est pas en double
            $mdp_hash = password_hash($password, PASSWORD_BCRYPT);
            $req = $db->prepare("INSERT INTO `users`(`nom_users`, `prenom_users`, `email_users`, `mdp_users`,`id_role`) VALUES (?,?,?,?,?)");
            // il manque le prenom 
            $req->execute([$nom,$prenom,$mail,$mdp_hash,2]);
            header("Location: ../connexion.php");
        }else{
            header("Location: ../inscription.php");
        }
    }else{
        //retourner a linscription pseudo deja pris
        header("Location: ../inscription.php");
    }

}   



?>