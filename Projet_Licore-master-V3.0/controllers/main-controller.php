<?php

require('./models/competences.php');
require('./models/utilisateurs.php');
require('./models/groupes.php');
require('./models/session.php');

// Affiche l'accueil du site
function accueil() {
    require('./views/accueil/index.php');
}

// Permet de gerer les competences
function gestionCompetences() {
    require('./views/tableau-de-bord/gestion-competences.php');
}

// Permet de valider des competences pour un tuteur
function validerCompetencesUtilisateurs() {
    require('./views/tableau-de-bord/valider-competences-utilisateurs.php');
}

function connexion() {
    require('./models/connexion.php');
    require('./views/connexion.php');
}

function deconnexion() {
    require('./models/deconnexion.php');
}

function genererPDF() {
    require('./views/pdf.php');
}

function gestionUtilisateurs() {
    require('./views/tableau-de-bord/gestion-utilisateurs.php');
}

function telechargementFichier() {
    require('./models/download.php');
}

function gestionGroupes() {
    require('./views/tableau-de-bord/gestion-groupes.php');
}

function rejoindreGroupe() {
    require('./views/accueil/rejoindre-groupe.php');
}

function exportHtml() {
    require('./views/exportHtml.php');
}

function statistique(){
    require('./views/tableau-de-bord/statistique.php');
}

function bilan(){
    require('./views/tableau-de-bord/bilan-des-competences.php');
}

function monGroupe() {
    require('./views/accueil/mon-groupe.php');
}

// Affiche une erreur
function erreur($msgErreur) {
    require('./views/erreur.php');
}
?>
