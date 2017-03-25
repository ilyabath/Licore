<?php $titre = 'Statistique'; ?>

<?php require('./views/layout/generic-modal.php'); ?>


<?php ob_start(); ?>

      <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                <div class="text-small-caps">Statistique</div>
              </div>
              <div id="panel-body-etudiants" class="panel-body">

                <FORM NAME="Choix" onchange="update('Parametre1')">
                  <li> Premier Parametre </li>
                  <SELECT id="Parametre1"> </SELECT>
                </FORM>
                <FORM NAME="Choix2" onchange="">
                  <li> Deuxieme Parametre </li>
                  <SELECT id="Parametre2"> </SELECT>
                </FORM>
                <button type="button" id="buttonStatistique" class="btn btn-default btn-gestion-competences " onclick="lancerStat('Parametre1','Parametre2')">Lancer le calcul</button>
                <ul id="Statistique" >
                  <li id="Statistique"></li>
                </ul>
              </div>
              <ul id="graph-container">
                <canvas id="container" style="width:75%; height:100px;"></canvas>
              </ul>
          </div>
      </div>


<?php $contenu = ob_get_clean(); ?>

<?php require('./views/layout/main.php'); ?>
