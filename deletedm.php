<?php
require('assets/includes/bootstrap.php');
$db = App::getDatabase();
$dm = App::getPrivateMessage();
$name = $_GET['name'];
$dm->deletePrivateMessage($db, $name);
Session::getInstance()->sendFlash('success', 'Discussion supprimée avec succès.');
App::redirect('index.php');
