<?php

require('assets/includes/bootstrap.php');
$auth = App::getAuth();
$auth->restrict();
$db = App::getDatabase();
if (!empty($_POST)) {
    $errors = array();
    if (empty($_POST['password_actual']) || !password_verify($_POST['password_actual'], $auth->getStudent()->password)) {
        $errors['password_actual'] = 'Votre mot de passe actuel est erroné';
    }

    if (empty($_POST['password']) || empty($_POST['password_confirm'])) {
        $errors['passwordempty'] = 'Veuillez remplir les champs demandés';
    }

    if (empty($_POST['password']) || !($_POST['password'] == $_POST['password_confirm'])) {
        $errors['password'] = 'Vos mots de passe ne correspondent pas';
    }

    if (empty($errors)) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $db->query('UPDATE students SET password = ? WHERE id = ?', [$password, $auth->getStudent()->id]);
        $auth->getSession()->sendFlash('success', 'Votre mot de passe a été correctement réinitialiser');
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Paramètres de votre compte</title>

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

    <link href="assets/css/style.css?3" rel="stylesheet">

</head>

<body>

<?php include('assets/includes/header.php'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-7">
            <div class="home-box">
                <div class="home-title">
                    <p>Vos informations</p>
                </div>
                <div class=" col-md-6 col-lg-6 hidden-xs hidden-sm">
                    <table class="table table-user-information">
                        <tbody>
                        <tr>
                            <td>Nom de famille</td>
                            <td><?= $auth->getStudent()->name; ?></td>
                        </tr>
                        <tr>
                            <td>Prénom</td>
                            <td><?= $auth->getStudent()->firstname; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?= $auth->getStudent()->status; ?></td>
                        </tr>
                        <?php if ($auth->getStudent()->grade != null): ?>
                            <tr>
                                <td>Classe</td>
                                <td><?= $auth->getStudent()->grade; ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
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
                <hr>
                <form action="" method="POST">

                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-lock-open text-primary"></i></div>
                            </div>
                            <input type="password" name="password_actual" class="form-control"
                                   placeholder="Mot de passe actuel"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-lock text-primary"></i></div>
                            </div>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Nouveau mot de passe"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-lock text-primary"></i></div>
                            </div>
                            <input type="password" name="password_confirm" class="form-control"
                                   placeholder="Confimer le mot de passe"/>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="Réinitialiser" class="btn btn-primary btn-block rounded-0 py-2">
                </form>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-9"></div>

        <div class="col-lg-3">
            <div class="home-box">
                <div class="home-title">
                    <p>Changer son avatar ?</p>
                </div>
                <hr>
                <div class="text-center">
                    <img src="students/avatars/<?= $auth->getStudent()->avatar; ?>" class="img-thumbnail">
                </div>
                <br>
                <form action="avatarchange.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-file-image"></i></div>
                            </div>
                            <input type="file" name="new_avatar" class="form-control"/>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="Mettre à jour" class="btn btn-primary btn-block rounded-0 py-2">
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
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>

</html>