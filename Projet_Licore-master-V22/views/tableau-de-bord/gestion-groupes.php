<?php $titre = 'Gestion des groupes'; ?>

<?php ob_start(); ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <div class="text-small-caps">Gestion des groupes</div>
            </div>
            <div class="panel-body">
              <div class="btn-group" role="group" aria-label="...">
                <button type="button" id="buttonCreationGroupe" class="btn btn-default btn-gestion-competences active">Créer un groupe</button>
                <button type="button" id="buttonModifierGroupe" class="btn btn-default btn-gestion-competences">Modifier un groupe</button>
                <button type="button" id="buttonGererGroupe" class="btn btn-default btn-gestion-competences">Gérer un groupe</button>
              </div>
              <br/><br/>
              <?php
              if(isset($_GET['choix'])){
                if($_GET['choix'] == 'modifier-groupe'){
                  include_once('/modifier-groupe.php');
                  include_once('/creer-groupe.php');
                }
                elseif($_GET['choix'] == 'gerer-groupe'){
                  //include_once('/modifier-groupe.php');
                  include_once('/gerer-groupe.php');
                }
                else{
                  include_once('/creer-groupe.php');
                }
              }
              else{
                  include_once('/creer-groupe.php');
              }
              ?>
            </div>
        </div>
    </div>
<?php $contenu = ob_get_clean(); ?>

<?php require('./views/layout/main.php'); ?>
