<?php

require('assets/includes/bootstrap.php');
App::getAuth()->restrict();

if (!empty($_POST)) {
    $errors = array();
    if (empty($_POST['password_actual']) || !password_verify($_POST['password_actual'], $_SESSION['auth']->password)) {
        $errors['password_actual'] = 'Votre mot de passe actuel est erroné';
    }

    if (empty($_POST['password']) || empty($_POST['password_confirm'])) {
        $errors['passwordempty'] = 'Veuillez remplir les champs demandés.';
    }

    if (empty($_POST['password']) || !($_POST['password'] == $_POST['password_confirm'])) {
        $errors['password'] = 'Vos mots de passe ne correspondent pas';
    }

    if (empty($errors)) {
        require('assets/includes/db.php');
        $req = $pdo->prepare('UPDATE students SET password = ? WHERE id = ?');
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $req->execute([$password, $_SESSION['auth']->id]);
        $_SESSION['flash']['success'] = 'Votre mot de passe a été correctement réinitialiser';
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Paramètres de votre compte</title>

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
        <div class="row">
            <div class="col-lg-4">
                <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger">
                        <p>Remplissez le formulaire d'inscription correctement:</p>
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li>
                                    <?= $error; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="home-box">
                    <div class="home-title">
                        <p>Réinitialiser son mot de passe ?</p>
                    </div>
                    <form action="" method="POST">
                        <input type="password" name="password_actual" class="form-control" placeholder="Mot de passe actuel" />
                        <input type="password" name="password" class="form-control" placeholder="Nouveau mot de passe" />
                        <input type="password" name="password_confirm" class="form-control" placeholder="Confimer le mot de passe" />
                        <button type="submit" name"submit" class="btn btn-primary">Réinitialiser</button>
                    </form>
                </div>
            </div>
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