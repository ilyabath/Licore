<?php
  function estUnUtilisateur($identifiant, $mdp) {
    global $bdd;

    $querySelect = $bdd->prepare("Select idUtilisateur, prenom, nom, idRole, idGroupe From utilisateur Where identifiant = :identifiant and mdp = :mdp");
    $querySelect->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
    $querySelect->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $querySelect->execute();

    if ($row = $querySelect->fetch()) {
      return array(
          'id' => $row['idUtilisateur'],
          'prenom' => $row['prenom'],
          'nom' => $row['nom'],
          'idRole' => $row['idRole'],
          'idGroupe' => $row['idGroupe']
      );
    }

     return array(
          'id' => -1
     );
  }

  function pagesAccessibles($idRole){
    global $bdd;
    $pages = array();

    $querySelect = $bdd->prepare("Select nomPage From acces Natural Join page Where idRole = :idRole");
    $querySelect->bindParam(':idRole', $idRole, PDO::PARAM_INT);
    $querySelect->execute();

    while($row = $querySelect->fetch()){
      $pages[] = $row['nomPage'];
    }

    return $pages;
  }

  function getRole($idRole){
    global $bdd;

    $querySelect = $bdd->prepare("Select nomRole From role Where idRole = :idRole");
    $querySelect->bindParam(':idRole', $idRole, PDO::PARAM_INT);
    $querySelect->execute();

    return $querySelect->fetchColumn();

  }

  if (isset($_POST['btnConnexion'])) {
    $identifiant = $_POST['inputIdentifiant'];
    $mdp = $_POST['inputMdp'];
    $utilisateur =  estUnUtilisateur($identifiant, $mdp);
    if ($utilisateur['id'] != -1) {
      if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
      }
      $_SESSION['idUtilisateur'] =  $utilisateur['id'];
      $_SESSION['prenom'] =  $utilisateur['prenom'];
      $_SESSION['nom'] =  $utilisateur['nom'];
      $_SESSION['acces'] = pagesAccessibles($utilisateur['idRole']);
      $_SESSION['idRole'] = $utilisateur['idRole'];
      $_SESSION['role'] = getRole($utilisateur['idRole']);
      $_SESSION['idGroupe'] = $utilisateur['idGroupe'];
      header('Location: index.php');
    }
    else {
      header('Location: index.php?action=connexion');
    }
  }
?>
