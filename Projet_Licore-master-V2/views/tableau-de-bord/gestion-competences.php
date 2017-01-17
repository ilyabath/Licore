<?php $titre = 'Gestion des compétences'; ?>

<?php require('./views/layout/generic-modal.php'); ?>

<?php ob_start(); ?>
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">
              <div class="text-small-caps">Gestion des compétences</div>
            </div>

            <div class="panel-body">
              <div class="btn-group" role="group" aria-label="...">
                <button type="button" id="buttonToutesCompetences" class="btn btn-default btn-gestion-competences active">Toutes les compétences</button>
                <button type="button" id="buttonCompetencesVisibles" class="btn btn-default btn-gestion-competences">Compétences visibles</button>
                <button type="button" id="buttonCompetencesInvisibles" class="btn btn-default btn-gestion-competences">Compétences invisibles</button>
              </div>
              <br/><br/>
              <div class="form-inline espace">
                <input id="search-bar-competence" type="search" class="input-md form-control" placeholder="Recherche d'une compétence par référence">
                <span id="search-competence" data-toggle="tooltip" data-placement="top" title="Lancer la recherche d'une compétence" class="glyphicon glyphicon-search cursor-pointer" aria-hidden="true"></span>
              </div>
              <div id="loader-competences">
                <img class="center" src="./images/loader.gif" alt="Chargement"/>
                <p class="center-text-loader">Chargement des compétences ...</p>
              </div>

              <ul id="arbreGestionCompetences" class="treeview"></ul>
            </div>

        </div>
    </div>
<?php $contenu = ob_get_clean(); ?>

<?php require('./views/layout/main.php'); ?>
