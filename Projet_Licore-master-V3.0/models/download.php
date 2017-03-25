<?php
if(isset($_POST['buttonSubmitFichier'])){
  // désactive le temps max d'exécution
  set_time_limit(0);

  if (!isset($_SESSION["idUtilisateur"])) {
      header("HTTP/1.1 403 Forbidden");
      exit;
  }

// on a bien une demande de téléchargement de fichier
  if (empty($_POST['nomFichier'])) {
      header("HTTP/1.1 404 Not Found");
      exit;
  }
// le nom doit être un nom de fichier
  if(basename($_POST['nomFichier']) != $_POST['nomFichier']) {
      header("HTTP/1.1 400 Bad Request");
      exit;
  }

  $name = $_POST['nomFichier'];
  $nameOriginal = $_POST['nomFichierOrigine'];


  // vérifie l'existence et l'accès en lecture au fichier
  $filename = DOC_ROOT_PATH . '/fichiersUtilisateurs/' .$name;

  if (!is_file($filename) || !is_readable($filename)) {
    header("HTTP/1.1 404 Not Found");
    exit;
  }

  $size = filesize($filename);

// désactivation compression GZip
  if (ini_get("zlib.output_compression")) {
      ini_set("zlib.output_compression", "Off");
  }

  // fermeture de la session
  session_write_close();

  // désactive la mise en cache
  header("Cache-Control: no-cache, must-revalidate");
  header("Cache-Control: post-check=0,pre-check=0");
  header("Cache-Control: max-age=0");
  header("Pragma: no-cache");
  header("Expires: 0");

  // force le téléchargement du fichier avec le nom original
  header("Content-Type: application/force-download");
  header('Content-Disposition: attachment; filename="'.$nameOriginal.'"');
  //header('Content-Disposition: attachment; filename="'.$name.'"');

// indique la taille du fichier à télécharger
  header("Content-Length: ".$size);

// envoi le contenu du fichier
  readfile($filename);

}
