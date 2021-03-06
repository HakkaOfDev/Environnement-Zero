<?php

require_once('assets/includes/bootstrap.php');

if (!empty($_POST)) {
    $errors = array();

    $db = App::getDatabase();
    $validator = new Validator($_POST);

    $validator->isRegister('name', $db, "Elève déjà enregistré");
    $validator->isEmailValidate('email', "Renseignez une email valide");
    $validator->isPasswordValidate('password', "Renseignez un mot de passe valide");

    if ($validator->isStudentValidate()) {
        App::getAuth()->register($db, $_POST['name'], $_POST['firstname'], $_POST['email'], $_POST['password'], $_POST['status'], $_POST['grade']);
        Session::getInstance()->sendFlash('success', "L'élève à été inscrit avec succès");
    } else {
        $errors = $validator->getErrors();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Environnement Zéro</title>

    <meta name="description" content="Environnement Zéro @2k20"
    <meta name="keywords" content="Environnement Zéro, application, free discu, env zero, envi zéro">
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
        <div class="home-title">Inscription à l'environnement</div>
        <hr>
        <form method="POST" action="">
            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-signature text-primary"></i></div>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="Nom de famille"/>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-signature text-primary"></i></div>
                    </div>
                    <input type="text" name="firstname" class="form-control" placeholder="Prénom"/>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-graduation-cap text-primary"></i></div>
                    </div>
                    <select class="form-control" name="status">
                        <option selected disabled>Profession</option>
                        <option>Elève</option>
                        <option>Professeur</option>
                        <option>Directeur</option>
                        <option>Administrateur</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-copyright text-primary"></i></div>
                    </div>
                    <select class="form-control" name="grade">
                        <option selected disabled>Classe</option>
                        <option>TS1</option>
                        <option>TS2</option>
                        <option>TES</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-at text-primary"></i></div>
                    </div>
                    <input type="text" name="email" class="form-control" placeholder="Email"/>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-lock text-primary"></i></div>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe"/>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-lock text-primary"></i></div>
                    </div>
                    <input type="password" name="password_confirm" class="form-control"
                           placeholder="Confirmez le mot de passe"/>
                </div>
            </div>
            <br>
            <input type="submit" value="Inscrire" class="btn btn-primary btn-block rounded-0 py-2">
        </form>
    </div>
</div>
</div>

</div>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>

</html>