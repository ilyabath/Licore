<?php $titre = 'Gestion des utilisateurs'; ?>

<?php ob_start(); ?>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
              <div class="text-small-caps">Liste des utilisateurs</div>
            </div>
            <div class="panel-body">
              <input id="search-bar" type="search" class="input-md form-control" placeholder="Recherche d'un utilisateur">
            </div>
             <div id="panel-body-utilisateurs" class="panel-body"></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
              <div class="text-small-caps">Rôle de l'utilisateur</div>
            </div>
            <div id="panel-body-roles" class="panel-body"></div>
        </div>
    </div>
<?php $contenu = ob_get_clean(); ?>

<?php require('./views/layout/generic-modal.php'); ?>
<?php require('./views/layout/main.php'); ?>
