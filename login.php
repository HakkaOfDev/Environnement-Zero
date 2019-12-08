<?php
require('assets/includes/bootstrap.php');
$auth = App::getAuth();
$db = App::getDatabase();
$auth->reconnectFromCookie($db);

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $student = $auth->login($db, $_POST['email'], $_POST['password'], isset($_POST['remember']));
    if($student){
        $auth->getSession()->sendFlash('success', "Authentification réussie");
        App::redirect('profil.php');
    } else {
        $auth->getSession()->sendFlash('danger', 'Identifiant ou mot de passe incorrecte');
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Environnement Zéro</title>

    <meta name="description" content="Environnement Zéro @2k20" <meta name="keywords" content="Environnement Zéro, application, free discu, env zero, envi zéro">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Environnement Zéro">
    <meta property="og:description" content="Environnement Zéro @2k20">
    <meta property="og:url" content="">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700" rel="stylesheet">

    <script src="https://kit.fontawesome.com/bd52915d7c.js" crossorigin="anonymous"></script>

    <meta name="author" content="Hakka,Ptit Nost">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

    <?php include('assets/includes/header.php'); ?>

    <div class="container-fluid">
        <div class="home-box">
            <div class="home-title">Connection à l'environnement</div>
            <hr>
            <form method="POST" action="">
                <input type="text" name="name" class="form-control" placeholder="Nom" />
                <br>
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" />
                <br>
                <div class="form-control">
                    <label>
                        <input type="checkbox" name="remember" value="1" />Se souvenir de moi
                    </label>
                </div>
                <button type="submit" name"submit" class="btn btn-primary">Se connecter</button>

            </form>
        </div>
    </div>
    </div>
    <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</body>

</html>