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

    <link href="https://www.env-zero.eu/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://www.env-zero.eu/assets/css/style.css" rel="stylesheet">

</head>

<body>

<?php include('https://www.env-zero.eu/assets/includes/header.php'); ?>

<div class="container-fluid">
    <div class="home-box">
        <div class="support-title">
            <p>F&Q</p>
            <hr>
        </div>
        <div>
            <button class="accordion"> 1er Question </button>
            <div class="panel"> <p> BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB</p> </div>
        </div>
        <br>
        <div>
            <button class="accordion"> 2er Question</button>
            <div class="panel"> <p>Lorem ipsum 20</p> </div>
        </div>
        <br>
        <div>
            <button class="accordion"> 3er Question</button>
            <div class="panel"> <p>Lorem ipsum 20</p> </div>
        </div>
        <br>
        <div>
            <button class="accordion"> 4er Question</button>
            <div class="panel"> <p>Lorem ipsum 20</p> </div>
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
<script src="https://www.env-zero.eu/assets/vendor/jquery/jquery.min.js"></script>
<script src="https://www.env-zero.eu/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>

</html>