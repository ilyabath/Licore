<?php

define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/'.'Projet_Licore-master');
include_once('../models/competences.php');
include_once('../models/utilisateurs.php');
include_once('../models/groupes.php');
include_once('../models/connexion_sql.php');

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

header('Content-Type: application/json; charset=utf-8');
$json = NULL;
$type = $_GET["type"];

switch ($type) {
  case 'sousCompetences':
    $idPere = $_GET["idPere"];
    $json = json_encode(getCompetencesFeuille($idPere));
    break;
  case 'getUtilisateursCompetence':
    $idCompetence = $_GET["idCompetence"];
    $json = json_encode(getUtilisateursCompetence($idCompetence));
    break;
  case 'getUtilisateurs':
    $nomUtilisateur = $_GET["nomUtilisateur"];
    $json = json_encode(getUtilisateurs($nomUtilisateur));
    break;
  case 'getRolesUtilisateur':
    $idUtilisateur = $_GET["idUtilisateur"];
    $json = json_encode(getRolesUtilisateur($idUtilisateur));
    break;
  case 'changerRoleUtilisateur':
    $idUtilisateur = $_GET["idUtilisateur"];
    $idRole = $_GET["idRole"];
    changerRoleUtilisateur($idUtilisateur,$idRole);
  case 'getCompetencesVisibles':
    $json = json_encode(getToutesLesCompetences('visibles'));
    break;
  case 'getCompetencesVisiblesSansFeuilles':
    $json = json_encode(getCompetencesVisibles());
    break;
  case 'getCompetencesInvisibles':
    $json = json_encode(getCompetencesInvisibles());
    break;
  case 'getCompetencesValides':
    if(isset($_GET["id"])){
      $id = $_GET["id"];
    }
    else{
      $id = 0;
    }
    $json = json_encode(getCompetencesValides($id));
    break;
  case 'getToutesLesCompetences':
    $json = json_encode(getToutesLesCompetences('toutes'));
    break;
  case 'getCompetencesValidation':
    $json = json_encode(getCompetencesValidation());
    break;
  case 'getComposantes':
    $json = json_encode(getComposantes());
    break;
  case 'getUtilisateursParRole':
    $role = $_GET["role"];
    $json = json_encode(getUtilisateursParRole($role));
    break;
  case 'validation':
  	$idCompetence = $_GET["idCompetence"];
    $explications = $_GET["explications"];

    if(isset($_GET['nomFichier'])){
      $nomFichier = $_GET['nomFichier'];
      $nomFichierOrigine = $_GET['nomFichierOrigine'];
      validerCompetence($idCompetence,$explications,$nomFichier,$nomFichierOrigine);
    }
    else{
      validerCompetence($idCompetence,$explications);
    }
  	break;
  case 'invalidation':
  	$idCompetence = $_GET["idCompetence"];
  	invaliderCompetence($idCompetence);
  	break;
  case 'creerUnGroupe':
    $nom = $_GET["nom"];
    $cle = $_GET["cle"];
    $taille = $_GET["taille"];
    $idComposante = $_GET["idComposante"];
    $idTuteur = $_GET["idTuteur"];
    $idEncadrant = $_GET["idEncadrant"];
    $json = json_encode(creerUnGroupe($nom,$cle,$taille,$idComposante,$idTuteur,$idEncadrant));
    break;
  case 'getExplicationsEtudiant':
    $idCompetence = $_GET["idCompetence"];
    $idUtilisateur = $_GET["idUtilisateur"];
    $json = json_encode(getExplicationsEtudiant($idCompetence,$idUtilisateur));
    break;
  case 'getExplications':
    $idCompetence = $_GET["idCompetence"];
    if(isset($_GET["idUtilisateur"])){
      $idUtilisateur = $_GET["idUtilisateur"];
      $json = json_encode(getExplications($idCompetence,$idUtilisateur));
    }
    else{
      $json = json_encode(getExplications($idCompetence));
    }
    break;
  case 'accepterValidation':
    $idCompetence = $_GET["idCompetence"];
    $idUtilisateur = $_GET["idUtilisateur"];
    validationCompetenceParTuteur($idCompetence,$idUtilisateur);
    break;
  case 'refuserValidation':
    $idCompetence = $_GET["idCompetence"];
    $idUtilisateur = $_GET["idUtilisateur"];
    $explications = $_GET["explications"];
    $nomFichier = $_GET["nomFichier"];
    $nomFichierOrigine = $_GET["nomFichierOrigine"];
    refuserValidationCompetenceParTuteur($idCompetence,$idUtilisateur,$explications,$nomFichier,$nomFichierOrigine);
    break;
  case 'getGroupes':
    $json = json_encode(getGroupes());
    break;
  case 'getGroupesRecherche':
    $nomGroupe = $_GET["nomGroupe"];
    $json = json_encode(getGroupesRecherche($nomGroupe));
    break;
  case 'getGroupe':
    $idGroupe = $_GET["idGroupe"];
    $json = json_encode(getGroupe($idGroupe));
    break;
  case 'ajouterCompetence':
    $idPere = $_GET["idCompetence"];
    $nomCompetence = $_GET["nomCompetence"];
    $definition = $_GET["definition"];
    $criteres = $_GET["criteres"];
    $json = json_encode(ajouterCompetence($idPere, $nomCompetence, $definition, $criteres));
    break;
  case 'ajouterPlusieursCompetences':
    $idPere = $_GET["idCompetence"];
    $nomsCompetences = $_GET["nomCompetence"];
    $json = json_encode(ajouterPlusieursCompetences($idPere, $nomsCompetences));
    break;
  case 'modifierCompetence':
    $idCompetence = $_GET["idCompetence"];
    $nomCompetence = $_GET["nomCompetence"];
    $definition = $_GET["definition"];
    $criteres = $_GET["criteres"];
    $json = json_encode(modifierCompetence($idCompetence, $nomCompetence, $definition, $criteres));
    break;
  case 'setCompetencesVisibles':
  	$idCompetence = $_GET["idCompetence"];
  	$json = json_encode(setCompetencesVisibles($idCompetence));
  	break;
  case 'setCompetencesInvisibles':
  	$idCompetence = $_GET["idCompetence"];
  	$json = json_encode(setCompetencesInvisibles($idCompetence));
  	break;
  case 'supprimerCompetence':
    $idCompetence = $_GET["idCompetence"];
    $nomCompetence = $_GET["nomCompetence"];
    supprimerCompetence($idCompetence, $nomCompetence);
    break;
  case 'estUneCompetenceFeuille':
    $reference = $_GET["reference"];
    $json = json_encode(estUneCompetenceFeuille($reference));
    break;
  case 'estConnecte':
    if(isset($_SESSION['idUtilisateur'])) {
      $json = json_encode(array('estConnecte' => true));
    } else {
      $json = json_encode(array('estConnecte' => false));
    }
    break;
  case 'modifierUnGroupe':
    $idGroupe = $_GET['idGroupe'];
    $nom = $_GET["nom"];
    $cle = $_GET["cle"];
    $taille = $_GET["taille"];
    $idComposante = $_GET["idComposante"];
    $idTuteur = $_GET["idTuteur"];
    $idEncadrant = $_GET["idEncadrant"];
    $json = json_encode(modifierUnGroupe($idGroupe,$nom,$cle,$taille,$idComposante,$idTuteur,$idEncadrant));
    break;
  case 'getUtilisateursGroupe':
    if(isset($_GET['idGroupe'])){
      $idGroupe = $_GET['idGroupe'];
    }
    else{
      $idGroupe = $_SESSION['idGroupe'];
    }
    $json = json_encode(getUtilisateursGroupe($idGroupe));
    break;
  case 'getNbUtilisateurGroupe':
    $idGroupe = $_GET['idGroupe'];
    $json = json_encode(getNbUtilisateurGroupe($idGroupe));
    break;
  case 'supprimerDuGroupe':
    $idGroupe = $_GET['idGroupe'];
    $tabUtilisateur = $_GET['idUtilisateur'];
    $json = json_encode(supprimerDuGroupe($idGroupe,$tabUtilisateur));
    break;
  case 'ajouterAuGroupe':
    $idGroupe = $_GET['idGroupe'];
    $tabUtilisateur = $_GET['idUtilisateur'];
    $json = json_encode(ajouterAuGroupe($idGroupe,$tabUtilisateur));
    break;
  case 'getEtudiantsSansGroupe':
    $nomEtudiant = $_GET["nomEtudiant"];
    $json = json_encode(getUtilisateurs($nomEtudiant,'groupe'));
    break;
  case 'rejoindreUnGroupe':
    $idGroupe = $_GET["idGroupe"];
    $cle = $_GET["cle"];
    $json = json_encode(rejoindreUnGroupe($idGroupe,$cle));
    break;
  case 'getIdEtudiant':
    $prenom = $_GET["prenom"];
    $nom = $_GET["nom"];
    $json = json_encode(getIdEtudiant($prenom, $nom));
    break;
  case 'getInfosSurLeGroupe':
    $json = json_encode(getInfosSurLeGroupe());
    break;
  case 'getCriteresEtDefinitionCompetence':
    $idCompetence = $_GET["idCompetence"];
    $json = json_encode(getCriteresEtDefinitionCompetence($idCompetence));
    break;
  case 'ArbreEtudiants':
    $json = json_encode(recupererArbreEtudiants());
    break;
  case 'PereCompetences':
    $json = json_encode(getCompetencesPere());
    break;
  case 'recupererStat':
    $idEtudiant = $_GET["idEtudiant"];
    $idCompetence = $_GET["idCompetence"];
    $json = json_encode(recupererStatEleveCompetence($idEtudiant,$idCompetence));
    break;
  case 'recupererStatCompetencesGeneral':
    $idCompetence = $_GET["idCompetence"];
    $json = json_encode(recupererStatCompetencesGeneral($idCompetence));
    break;
  default:
    $json = erreurApi("Il faut renseigner le type");
    break;
}

function erreurApi($message) {
  return '{"erreur" : '. $message . '}';
}

echo $json;

?>
