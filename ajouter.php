<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une video</title>
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

                <h1>Ajouter une vidéo</h1>
                <a href="index.php">retour à l'accueil</a>
                <form action='users/traitement_add.php' method="post">

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control">


                    </div>
                    <div class="form-group">
                        <label for="description">description</label>
                        <input type="text" id="description" name="description" class="form-control">


                    </div>

                    <div class="form-group">
                        <label for="lien">lien</label>
                        <input type="text" id="lien" name="lien" class="form-control">


                    </div>

                    <div class="form-group">
                        <label for="image">image</label>
                        <input type="text" id="image" name="image" class="form-control">


                    </div>


                        <button type='submit' class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>

    </main>

    
</body>
</html>
