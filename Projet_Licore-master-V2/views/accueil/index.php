<?php $titre = 'Mes compétences'; ?>

<?php ob_start(); ?>
    <div id="col-liste-competences" class="col-md-4">
         <!-- include(DOC_ROOT_PATH . '/views/accueil/liste-competences.php'); -->
        <?php include('liste-competences.php'); ?>
    </div>

    <div id="col-competences-a-valider" class="col-md-4">
        <!-- include(DOC_ROOT_PATH . '/views/accueil/competences-a-valider.php'); -->
        <?php include('competences-a-valider.php'); ?>
    </div>

    <div id="col-competences-validees" class="col-md-4">
         <!-- include(DOC_ROOT_PATH . '/views/accueil/liste-competences-validees.php'); -->
        <?php include('liste-competences-validees.php'); ?>
    </div>
<?php $contenu = ob_get_clean(); ?>

<?php require('./views/layout/generic-modal.php'); ?>
<?php require('connexion-modal.php'); ?>
<?php require('./views/layout/main.php'); ?>

<?= $scripts ?>
