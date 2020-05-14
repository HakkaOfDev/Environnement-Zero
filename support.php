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
    <link href="assets/css/support.css" rel="stylesheet">

</head>

<body>

<?php include('assets/includes/header.php'); ?>

<div class="container-fluid">
    <div class="home-box">
        <div class="support-title">
            <p>F&Q</p>
            <hr>
        </div>
        <div>
            <button class="accordion"> Qu'est-ce que l'Environnement Zéro ? </button>
            <div class="panel"> <p> C'est tout bonnement la meilleure question non ? </p><p>C'est l'environnement de travail parfait, il assemble discussions privées, par classe et propose un cloud pour des sauvegardes de fichiers !</p> </div>
        </div>
        <br>
        <div>
            <button class="accordion"> Les Box'it ? </button>
            <div class="panel"> <p> Ce sont les discussions par classe, dedans vous y trouverez votre classe et des discussions autres telles que maths ou physique..</p> </div>
        </div>
        <br>
        <div>
            <button class="accordion"> Comment avoir un accès ? </button>
            <div class="panel"> <p> Il suffit de faire partie intégrante d'un établissement. Et postulez sa demande à l'adresse suivante : contact@env-zero.fr</p> </div>
        </div>
        <br>
        <div>
            <button class="accordion"> Un futur ? </button>
            <div class="panel"> <p> Nous souhaitons créer une rubrique avec des exercices hebdomadaire !</p> </div>
        </div>
    </div>
</div>




<!-- Js Acoordion -->
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>



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