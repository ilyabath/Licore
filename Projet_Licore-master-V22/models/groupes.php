<?php

function getComposantes(){
  global $bdd;
  $composantes = array();

	$querySelect = $bdd->prepare("Select idComposante, nomComposante From composante Order by nomComposante");
	$querySelect->execute();

  while($row = $querySelect->fetch()){
    $composante = array(
      'id' => intval($row['idComposante']),
      'nom' => $row['nomComposante']
    );

    $composantes[] = $composante;
  }

  return $composantes;
}

function getUtilisateursParRole($role){
  global $bdd;
  $utilisateurs = array();

  if(strcmp($role,"Encadrant") == 0){
    $role = "Enseignant";
  }

  $querySelect = $bdd->prepare("Select idUtilisateur, prenom, nom From utilisateur Natural Join role Where nomRole = :nomRole");
  $querySelect->bindParam(':nomRole', $role, PDO::PARAM_STR);
	$querySelect->execute();

  while($row = $querySelect->fetch()){
    $utilisateur = array(
      'id' => intval($row['idUtilisateur']),
      'prenom' => $row['prenom'],
      'nom' => $row['nom']
    );

    $utilisateurs[] = $utilisateur;
  }

  return $utilisateurs;
}

function creerUnGroupe($nom,$cle,$taille,$idComposante,$idTuteur,$idEncadrant){
  global $bdd;
  $ok = true;

  /*if((!is_string($nom)) || (strlen($nom) > 250)){
    $ok = false;
  }
  if((!is_string($cle)) || (strlen($cle) > 250)){

  }
  if((!is_int($taille)) || ($taille < 1) || ($taille > 99)){

  }
  if(!is_int($idComposante)){

  }
  if(!is_int($idTuteur)){

  }
  if(!is_int($idEncadrant)){

  }*/

  $queryInsert = $bdd->prepare("Insert into groupe (nomGroupe, cle, taille, idTuteur, idEncadrant) Values (:nomGroupe, :cle, :taille, :idTuteur, :idEncadrant)");
  $queryInsert->bindParam(':nomGroupe', $nom, PDO::PARAM_STR);
  $queryInsert->bindParam(':cle', $cle, PDO::PARAM_STR);
  $queryInsert->bindParam(':taille', $taille, PDO::PARAM_INT);
  $queryInsert->bindParam(':idTuteur', $idTuteur, PDO::PARAM_INT);
  $queryInsert->bindParam(':idEncadrant', $idEncadrant, PDO::PARAM_INT);
  $retour = $queryInsert->execute();

  if($retour){
    $idGroupe = $bdd->lastInsertId();
    $queryInsert = $bdd->prepare("Insert into groupecomposante (idGroupe, idComposante) Values (:idGroupe, :idComposante)");
    $queryInsert->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
    $queryInsert->bindParam(':idComposante', $idComposante, PDO::PARAM_INT);
    $retour = $queryInsert->execute();
  }

  return array(
    'ok' => $retour
  );
}

function getGroupes(){
  global $bdd;
  $groupes = array();

	$querySelect = $bdd->prepare("Select idGroupe, nomGroupe From groupe Order by nomGroupe");
	$querySelect->execute();

  while($row = $querySelect->fetch()){
    $groupe = array(
      'id' => intval($row['idGroupe']),
      'nom' => $row['nomGroupe']
    );

    $groupes[] = $groupe;
  }

  return $groupes;
}

function getGroupe($idGroupe){
  global $bdd;

	$querySelect = $bdd->prepare("Select nomGroupe, cle, taille, idComposante, idTuteur, idEncadrant From groupe Natural Join groupecomposante Where idGroupe = :idGroupe");
  $querySelect->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
	$querySelect->execute();

  $row = $querySelect->fetch();

  return array(
    'nom' => $row['nomGroupe'],
    'cle' => $row['cle'],
    'taille' => $row['taille'],
    'idComposante' => intval($row['idComposante']),
    'idTuteur' => intval($row['idTuteur']),
    'idEncadrant' => intval($row['idEncadrant'])
  );
}

function modifierUnGroupe($idGroupe,$nom,$cle,$taille,$idComposante,$idTuteur,$idEncadrant){
  global $bdd;

  $queryUpdate = $bdd->prepare("Update groupe Set nomGroupe = :nomGroupe, cle = :cle, taille = :taille, idTuteur = :idTuteur, idEncadrant = :idEncadrant Where idGroupe = :idGroupe");
  $queryUpdate->bindParam(':nomGroupe', $nom, PDO::PARAM_STR);
  $queryUpdate->bindParam(':cle', $cle, PDO::PARAM_STR);
  $queryUpdate->bindParam(':taille', $taille, PDO::PARAM_INT);
  $queryUpdate->bindParam(':idTuteur', $idTuteur, PDO::PARAM_INT);
  $queryUpdate->bindParam(':idEncadrant', $idEncadrant, PDO::PARAM_INT);
  $queryUpdate->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
  $retour = $queryUpdate->execute();

  if($retour){
    $queryUpdate = $bdd->prepare("Update groupecomposante Set idComposante = :idComposante Where idGroupe = :idGroupe");
    $queryUpdate->bindParam(':idComposante', $idComposante, PDO::PARAM_INT);
    $queryUpdate->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
    $retour = $queryUpdate->execute();
  }

  return array(
    'ok' => $retour
  );
}

function getUtilisateursGroupe($idGroupe){
  global $bdd;
  $utilisateurs = array();

	$querySelect = $bdd->prepare("Select idUtilisateur, prenom, nom From utilisateur Where idGroupe = :idGroupe Order by nom, prenom");
  $querySelect->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
	$querySelect->execute();

  while($row = $querySelect->fetch()){
    $utilisateur = array(
      'id' => intval($row['idUtilisateur']),
      'prenom' => $row['prenom'],
      'nom' => $row['nom']
    );

    $utilisateurs[] = $utilisateur;
  }

  return $utilisateurs;
}

function getNbUtilisateurGroupe($idGroupe){
  global $bdd;

	$querySelect = $bdd->prepare("Select Count(*) From utilisateur Where idGroupe = :idGroupe");
  $querySelect->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
	$querySelect->execute();

  $nbUtilisateur = $querySelect->fetchColumn();

  $querySelect = $bdd->prepare("Select taille From groupe Where idGroupe = :idGroupe");
  $querySelect->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
	$querySelect->execute();

  $taille = $querySelect->fetchColumn();

  return array(
    'nbUtilisateur' => intval($nbUtilisateur),
    'taille' => intval($taille)
  );
}

function supprimerDuGroupe($idGroupe,$tabIdUtilisateur){
  global $bdd;

  for($i=0;$i<sizeof($tabIdUtilisateur);$i++){
    $querySelect = $bdd->prepare("Select idGroupe From utilisateur Where idUtilisateur = :idUtilisateur");
    $querySelect->bindParam(':idUtilisateur', $tabIdUtilisateur[$i], PDO::PARAM_INT);
	  $querySelect->execute();

    if($querySelect->fetchColumn() == $idGroupe){
      $queryUpdate = $bdd->prepare("Update utilisateur Set idGroupe = null Where idUtilisateur = :idUtilisateur");
      $queryUpdate->bindParam(':idUtilisateur', $tabIdUtilisateur[$i], PDO::PARAM_INT);
      $queryUpdate->execute();
    }
  }
}

function ajouterAuGroupe($idGroupe,$tabIdUtilisateur){
  global $bdd;
  $res = false;

  for($i=0;$i<sizeof($tabIdUtilisateur);$i++){
    $querySelect = $bdd->prepare("Select idGroupe From utilisateur Where idUtilisateur = :idUtilisateur");
    $querySelect->bindParam(':idUtilisateur', $tabIdUtilisateur[$i], PDO::PARAM_INT);
	  $querySelect->execute();

    if($querySelect->fetchColumn() == null){
      $queryUpdate = $bdd->prepare("Update utilisateur Set idGroupe = :idGroupe Where idUtilisateur = :idUtilisateur");
      $queryUpdate->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
      $queryUpdate->bindParam(':idUtilisateur', $tabIdUtilisateur[$i], PDO::PARAM_INT);
      $res = $queryUpdate->execute();
    }
  }

  return array(
    'res' => $res
  );
}

function rejoindreUnGroupe($idGroupe,$cle){
  global $bdd;
  $res = false;

  $querySelect = $bdd->prepare("Select * From groupe Where idGroupe = :idGroupe and cle = :cle ");
  $querySelect->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
  $querySelect->bindParam(':cle', $cle, PDO::PARAM_STR);
	$querySelect->execute();

  if($querySelect->fetch()){
    $res = ajouterAuGroupe($idGroupe,[$_SESSION['idUtilisateur']]);
    if($res){
      $_SESSION['idGroupe'] = $idGroupe;
    }
  }

  return array(
    'res' => $res
  );
}

function getInfosSurLeGroupe(){
  global $bdd;

  $querySelect = $bdd->prepare("Select nomGroupe, idTuteur, idEncadrant From groupe Where idGroupe = :idGroupe");
  $querySelect->bindParam(':idGroupe', $_SESSION['idGroupe'], PDO::PARAM_INT);
	$querySelect->execute();

  $row = $querySelect->fetch();

  return array(
    'nom' => $row['nomGroupe'],
    'nomTuteur' => getNomCompletUtilisateur($row['idTuteur']),
    'nomEnseignant' => getNomCompletUtilisateur($row['idEncadrant'])
  );
}

function getGroupesRecherche($nom){
  global $bdd;
  $groupes = array();
  $nomGroupe = '%' . strtoupper($nom) . '%';

	$querySelect = $bdd->prepare("Select idGroupe, nomGroupe From groupe Where Ucase(nomGroupe) Like :nomGroupe Order by nomGroupe");
  $querySelect->bindParam(':nomGroupe', $nomGroupe, PDO::PARAM_STR);
	$querySelect->execute();

  while($row = $querySelect->fetch()){
    $groupe = array(
      'id' => intval($row['idGroupe']),
      'nom' => $row['nomGroupe']
    );

    $groupes[] = $groupe;
  }

  return $groupes;
}

?>
