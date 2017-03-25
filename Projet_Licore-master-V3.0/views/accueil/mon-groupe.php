<?php $titre = 'Mon groupe' ?>

<?php ob_start(); ?>
<div class= "col-md-8 col-md-offset-2">
  <div class="panel panel-default">
    <div class="panel-heading">
      <span class="text-small-caps">Informations sur le groupe</span>
    </div>
    <div class="panel-body">
      <form class="form-horizontal">
        <div class="form-group">
          <label for="spanNom" class="col-sm-3 col-sm-offset-2 control-label">Nom du groupe :</label>
          <div class="col-sm-4">
            <span id="spanNom" name="spanNom" class="form-control"></span>
          </div>
        </div>
        <div class="form-group">
          <label for="spanTuteur" class="col-sm-3 col-sm-offset-2 control-label">Tuteur :</label>
          <div class="col-sm-4">
            <span id="spanTuteur" name="spanTuteur" class="form-control"></span>
          </div>
        </div>
        <div class="form-group">
          <label for="spanEnseignant" class="col-sm-3 col-sm-offset-2 control-label">Enseignant :</label>
          <div class="col-sm-4">
            <span id="spanEnseignant" name="spanEnseignant" class="form-control"></span>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class= "col-md-8 col-md-offset-2">
  <div class="panel panel-default">
    <div class="panel-heading">
      <span class="text-small-caps">Les membres du groupe</span>
    </div>
    <div id="panel-body-etudiant-groupe" class="panel-body">
    </div>
  </div>
</div>
<?php $contenu = ob_get_clean(); ?>

<?php require('./views/layout/main.php'); ?>
