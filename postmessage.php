<?php
require ('assets/includes/bootstrap.php');
$messages = htmlentities($_POST['messages']);

$db = App::getDatabase();
$auth = App::getAuth();
$dm = App::getPrivateMessage()->getPrivateMessage($db, $auth->getStudent()->name, $auth->getUserById($db, $_POST['id'])->name);

$query = $db->query("INSERT INTO {$dm} (id_student, message_content) VALUES (?,?)", [$auth->getStudent()->id, $messages]);

?>