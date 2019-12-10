<?php

require_once ('assets/includes/bootstrap.php');

if(isset($_FILES['new_avatar']) AND !empty($_FILES['new_avatar']['name'])){
    $sizeMax = 2097152;
    $extensionValides = array('jpg', 'jpeg', 'gif', 'png');
    $auth = App::getAuth();
    $db = App::getDatabase();

    if($_FILES['new_avatar']['size'] <= $sizeMax){
        $extensionUploaded = strtolower(substr(strrchr($_FILES['new_avatar']['name'], '.'), 1));
        if(in_array($extensionUploaded, $extensionValides)){
            $folder = "students/avatars/". $auth->getStudent()->id . "." . $extensionUploaded;
            $result = move_uploaded_file($_FILES['new_avatar']['tmp_name'], $folder);
            if($result){
                $db->query('UPDATE students SET avatar = ? WHERE id = ?', [$auth->getStudent()->id . "." . $extensionUploaded, $auth->getStudent()->id]);
                App::redirect('profil.php');
                $auth->getSession()->sendFlash('success', "Votre photo de profil a été mis à jour.");
            } else {
                $auth->getSession()->sendFlash('danger', "Une erreur s'est produite.");
            }
        } else {
            $auth->getSession()->sendFlash('warning', "Votre photo de profil doit être au format jpeg, jpg, png ou gif.");
        }
    } else {
        $auth->getSession()->sendFlash('warning', "Votre photo de profil ne doit pas dépasser 2Mo");
    }
}