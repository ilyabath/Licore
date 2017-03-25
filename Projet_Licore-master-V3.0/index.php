<?php

define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/'.'Projet_Licore-master');

include_once('controllers/main-controller.php');
include_once('models/connexion_sql.php');


try {
  if (isset($_GET['action'])) {
    if (($_GET['action'] == 'gestion-competences') && (estAccessible('gestion-competences'))) {
        gestionCompetences();
    }
    elseif (($_GET['action'] == 'valider-competences-utilisateurs') && (estAccessible('valider-competences-utilisateurs'))) {
        validerCompetencesUtilisateurs();
    }
    elseif (($_GET['action'] == 'connexion') && (!estConnecte())) {
        connexion();
    }
    elseif (($_GET['action'] == 'deconnexion') && (estConnecte())) {
        deconnexion();
    }
    elseif (($_GET['action'] == 'pdf') && (estConnecte())) {
        genererPDF();
    }
    elseif (($_GET['action'] == 'gestion-utilisateurs') && (estAccessible('gestion-utilisateurs'))) {
        gestionUtilisateurs();
    }
    elseif (($_GET['action'] == 'statistique') && (estAccessible('statistique'))){
        statistique();
    }
    elseif (($_GET['action'] == 'bilan') && (estAccessible('bilan'))){
        bilan();
    }
    elseif (($_GET['action'] == 'telechargement-fichier') && (estConnecte())){
        telechargementFichier();
    }
    elseif (($_GET['action'] == 'gestion-groupes') && (estAccessible('gestion-groupes'))){
        gestionGroupes();
    }
    elseif (($_GET['action'] == 'rejoindre-groupe') && (estAccessible('rejoindre-groupe')) && ($_SESSION['idGroupe'] == null)){
        rejoindreGroupe();
    }
    elseif (($_GET['action'] == 'exportHtml') && (isset($_GET['prenom'])) && (isset($_GET['nom'])) && (isset($_GET['ident'])) && (estUnEtudiantValide($_GET['prenom'], $_GET['nom'], $_GET['ident']))){
        exportHtml();
    }
    elseif (($_GET['action'] == 'mon-groupe') && (estAccessible('mon-groupe')) && ($_SESSION['idGroupe'] != null)){
        monGroupe();
    }
    else {
        throw new Exception("Erreur 503 : Accès refusé, vos droits d'accès ne permettent pas d'accéder à cette ressource");
    }
  }
  else {
    if((!estConnecte()) || (estAccessible('mes-competences'))){
      accueil();
    }
    else{
      header('Location: index.php?action=valider-competences-utilisateurs');
    }
  }
}
catch (Exception $e) {
    erreur($e->getMessage());
}
