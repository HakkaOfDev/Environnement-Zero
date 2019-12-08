<?php
require('assets/includes/bootstrap.php');
$auth = App::getAuth();
$db = App::getDatabase();
$auth->reconnectFromCookie($db);
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
        <div class="row">
            <div class="col-lg-8"></div>
            <div class="col-lg-4">
                <div class="home-box">
                    <div class="home-title">
                        <p>Dernières nouveautés</p>
                    </div>
                    <hr>
                    <?php foreach ($db->query('SELECT * FROM news ORDER BY id DESC')->fetchAll() as $new) : ?>
                        <div class="home-box">
                            <div class="home-title text-center">
                                <p> <?= $new->news_title; ?> </p>
                            </div>
                            <hr>
                            <p><?= $new->news_content; ?></p>
                        </div>
                    <?php endforeach; ?>
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