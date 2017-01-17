<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

$filename = $_SESSION['idUtilisateur'] . '-' . date("d-m-Y-H-i-s") . '-' . basename($_FILES['fichier']['name']);

if (move_uploaded_file($_FILES['fichier']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/'.'Projet_Licore-master'.'/'.'fichiersUtilisateurs/'. $filename)) {
    $data = $filename;
}
else {
    $data = "0";
}

echo $data;
?>
