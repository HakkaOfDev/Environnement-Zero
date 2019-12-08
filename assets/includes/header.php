<?php
require_once('assets/includes/bootstrap.php');

$auth = App::getAuth();
$student = $auth->getStudent();
?>

<div class="d-flex" id="wrapper">

    <div class="bg-dark border-right" id="sidebar-wrapper">
        <a href="index.php">
            <div class="sidebar-heading custom-brand">Environnement Zérø</div>
        </a>
        <div class="list-group list-group-flush">
            <?php if ($student != null) : ?>
                <div class="dropdown-divider"></div>
                <a class="text-uppercase sidebar-separator-title text-muted align-items-center d-flex"><small><i class="fab fa-discourse"></i> Discussions</small></a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-muted"><img src="assets/img/test-avatar.jpg" class="rounded-circle" height="30px" width="30px"> FREIRE Corentin</a>
                <div class="dropdown-divider"></div>
            <?php endif; ?>
            <a href="#" class="list-group-item list-group-item-action bg-dark">Support</a>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action bg-dark">Test</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a class="sidebar-separator-title text-muted align-items-center d-flex" href="#">Home 1</a>
                </li>
            </ul>
            <a href="#" class="list-group-item list-group-item-action bg-dark">Contact</a>
        </div>
    </div>

    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
            <button class="btn btn-primary" id="menu-toggle"><i class="fa fa-bars"></i></button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <?php if ($student != null) : ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <large class="text-uppercase"><?= $student->name; ?></large> <?= $student->firstname; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profil.php">Paramètres</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Déconnexion</a>
                            </div>
                        </li>

                    <?php else : ?>

                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Se connecter</a>
                        </li>

                    <?php endif; ?>
                    <!--
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Dropdown
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        -->
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <?php if (Session::getInstance()->hasFlashed()) : ?>
                <?php foreach (Session::getInstance()->getFlashes() as $type => $message) : ?>
                    <div class="alert alert-<?= $type; ?>">
                        <?= $message; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>