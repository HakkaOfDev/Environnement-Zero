<?php
require_once('bootstrap.php');
$db = App::getDatabase();
$auth = App::getAuth();
$student = $auth->getStudent();
$dm = App::getPrivateMessage();
?>

<div class="d-flex" id="wrapper">
    <div class="bg-dark border-right" id="sidebar-wrapper">
        <a href="#">
            <div class="sidebar-heading custom-brand">Environnement Zérø</div>
        </a>
        <div class="list-group list-group-flush">
            <?php if ($student != false) : ?>
                <div class="dropdown-divider"></div>
                <a class="text-uppercase sidebar-separator-title text-muted align-items-center d-flex section-title">
                    <div class="p-2"></div>
                    <small><i class="fas fa-search"></i> Discussions</small>
                </a>

                <?php foreach($db->query('SELECT * FROM students')->fetchAll() as $target):
                    if($target->name !== $student->name):
                        if($dm->hasPrivateMessage($db, $target->name, $student->name)): ?>
                            <a href="fastmessage.php?target=<?= $target->id; ?>" class="list-group-item list-group-item-action bg-dark text-white section-title"><img
                            src="students/avatars/<?= $target->avatar; ?>" class="rounded-circle" height="30px" width="30px"> <?= strtoupper($target->name); ?> <?= $target->firstname; ?></a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <div class="dropdown-divider"></div>
                <a href="#boxit" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle list-group-item list-group-item-action bg-dark text-white section-title">Box'it</a>
                <div class="collapse" id="boxit">
                    <a href="fastmessage.php?target=<?= $student->grade; ?>"
                       class="sidebar-separator-title align-items-center text-white d-flex section-title p-2 section-subcontent">
                        <div class="p-3"></div>
                        <small><i class="fas fa-angle-double-right"></i> <?= $student->grade; ?></small>
                    </a>
                </div>
                <div class="dropdown-divider"></div>
            <?php endif; ?>
            <a href="support.php" class="list-group-item list-group-item-action bg-dark text-white section-title">Support</a>
        </div>
    </div>

    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
            <button class="btn btn-primary" id="menu-toggle"><i class="fa fa-bars"></i></button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <?php if ($student != false) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="students/avatars/<?= $student->avatar; ?>" class="rounded-circle"
                                     height="30px" width="30px">
                                <large class="text-uppercase" id ="pseudo">  <?= $student->name; ?></large> <?= $student->firstname; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profil.php">Paramètres</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Déconnexion</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <button class="nav-link dropdown-toggle btn btn-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-address-book color-white" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <?php 
                                foreach ($db->query('SELECT * FROM students')->fetchAll() as $target) :
                                    if($target->name !== $student->name): ?>
                                        <a class="dropdown-item" href="fastmessage.php?target=<?= $target->id; ?>"><img src="students/avatars/<?= $target->avatar; ?>" class="rounded-circle"
                                         height="20px" width="20px"> <?= strtoupper($target->name).' '.$target->firstname; ?> <i class="fa fa-comment" aria-hidden="true"></i></a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Se connecter</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <!-- Flashes Messages -->
        <div class="container-fluid">
            <?php if (Session::getInstance()->hasFlashed()) : ?>
                <?php foreach (Session::getInstance()->getFlashes() as $type => $message) : ?>
                    <div class="alert alert-<?= $type; ?>">
                        <?= $message; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>