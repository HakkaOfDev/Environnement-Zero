<?php
require('assets/includes/bootstrap.php');
$auth = App::getAuth();
$db = App::getDatabase();
$auth->reconnectFromCookie($db);
$dm = App::getPrivateMessage();

$targetid = $_GET['target'];

$user = $auth->getUserById($db, $targetid);

if (!($dm->hasPrivateMessage($db, $auth->getStudent()->name, $user->name))) {
    $dm->createPrivateMessage($db, $auth->getStudent()->name, $user->name);
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

    <link href="assets/css/style.css?8" rel="stylesheet">
    <link href="assets/css/dm.css?6" rel="stylesheet">

</head>

<body>

<?php include('assets/includes/header.php'); ?>
<div class="fastmessagebg">
    <div class="bg-dark d-flex align-items-center justify-content-center target-border">
        <div class="border-content">
            <img src="students/avatars/<?= $auth->getUserById($db, $_GET['target'])->avatar; ?>" class="rounded-circle"
                 height="40px" width="40px">
        </div>
        <div class="border-content">
            <p class="targetauthor closebutton"><?= strtoupper($auth->getUserById($db, $_GET['target'])->name) . ' ' . $auth->getUserById($db, $_GET['target'])->firstname; ?>
                <span class="text-muted">#<?= $_GET['target']; ?></span></p>
        </div>
        <div class="border-content">
            <a href="deletedm.php?name=<?= $dm->getPrivateMessage($db, $auth->getUserById($db, $_GET['target'])->name, $auth->getStudent()->name); ?>"
               class="btn btn-danger closebutton" role="button"><i class="fas fa-times-circle"></i></a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="id_target" id="<?= $_GET['target']; ?>"></div>
        <div class="chat">
            <div class="messages" id="messages">

            </div>
            <textarea class="entry" rows="1" data-min-rows="1"
                      placeholder="Ecrivez votre message içi... (SHIFT+Entrée pour sauter une ligne)"></textarea>
        </div>
    </div>
</div>
</div>
</div>

</div>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/postmessage.js"></script>
<script src="assets/js/getmessages.js"></script>
<script src="assets/js/main.js"></script>

<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>

</html>