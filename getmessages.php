<?php

require ('assets/includes/bootstrap.php');
$db = App::getDatabase();
$auth = App::getAuth();
$dm = App::getPrivateMessage()->getPrivateMessage($db, $auth->getStudent()->name, $auth->getUserById($db, $_POST['id'])->name);

$query = $db->query("SELECT * FROM {$dm} ORDER BY date ASC");
foreach ($query->fetchAll() as $message) {
    $date = new DateTime($message->date);
	?>
    <p class="author"><?php echo $auth->getUserById($db, $message->id_student)->name; ?> | <?php echo $date->format('d/m/Y à H:i:s'); ?></p>
		<p class="content"><?php echo nl2br($message->message_content); ?></p>
	<?php
}
