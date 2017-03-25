<?php $titre = 'bilanDesCompetences'; ?>

<?php require('./views/layout/generic-modal.php'); ?>


<?php ob_start(); ?>
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">
              <div class="text-small-caps">Bilan de competences</div>
            </div>
            <button type="button" id="buttonStatistiqueEtudiants" class="btn btn-default btn-gestion-competences active" onclick="">Bilan des étudiants</button>
            <button type="button" id="buttonStatistiqueCompetences" class="btn btn-default btn-gestion-competences " onclick="majAffichageBilan(12)">Commencer le bilan</button>

              <ul id="arbreListeCompetences" class="treeview">
                <li id="listeCompetences"></li>
              </ul>
              <ul id="Valider">
              
              </ul>
            </div>

        </div>
    </div>
<?php $contenu = ob_get_clean(); ?>

<?php require('./views/layout/main.php'); ?>
