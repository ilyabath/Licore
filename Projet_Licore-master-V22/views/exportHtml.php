<?php $titre = 'Compétences de l\'étudiant ' . $_GET['prenom'] . ' ' . $_GET['nom']; ?>

<?php ob_start(); ?>
<div class= "col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <span class="text-small-caps">Arbre des compétences validées de <?php echo $_GET['prenom'] . ' ' . $_GET['nom'] ?></span>
    </div>
    <div id="col-competences-validees">
      <div id="panel-body-competences-validees" class="panel-body">
          <div id="loader-competences-validees">
            <img class="center" src="./images/loader.gif" alt="Chargement"/>
            <p class="center-text-loader">Chargement des compétences ...
            </p>
          </div>
          <ul id="arbreListeCompetencesValidees" class="treeview"></ul>
      </div>
    </div>
  </div>
</div>
<?php $contenu = ob_get_clean(); ?>

<?php require('./views/layout/main.php'); ?>
