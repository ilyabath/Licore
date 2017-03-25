<?php $titre = 'Validation des compétences'; ?>

<?php require('./views/tableau-de-bord/validation-utilisateurs-modal.php'); ?>

<?php ob_start(); ?>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
              <div class="text-small-caps">Liste des compétences</div>
            </div>

            <div class="panel-body">
              <div id="loader-competences">
                <img class="center" src="./images/loader.gif" alt="Chargement"/>
                <p class="center-text-loader">Chargement des compétences ...</p>
              </div>
              <div class="form-inline espace">
                <input id="search-bar-competence" type="search" class="input-md form-control" placeholder="Recherche d'une compétence par référence">
                <span id="search-competence" data-toggle="tooltip" data-placement="top" title="Lancer la recherche d'une compétence" class="glyphicon glyphicon-search cursor-pointer" aria-hidden="true"></span>
              </div>
              <ul id="arbreValidationCompetences" class="treeview">
                <li id="listeCompetences"></li>
              </ul>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
              <div class="text-small-caps">Validation des étudiants</div>
            </div>
            <div id="panel-body-etudiants" class="panel-body"></div>
        </div>
    </div>
<?php $contenu = ob_get_clean(); ?>

<?php require('./views/layout/main.php'); ?>
