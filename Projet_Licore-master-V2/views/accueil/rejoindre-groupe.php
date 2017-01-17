<?php $titre = 'Rejoindre un groupe'; ?>

<?php ob_start(); ?>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
              <div class="text-small-caps">Rejoindre un groupe</div>
            </div>
            <div id="panel-body-inscription" class="panel-body">
              <?php include_once(DOC_ROOT_PATH . '/views/tableau-de-bord/modifier-groupe.php'); ?>
              <form class="form-horizontal" id="formRejoindregroupe">
                <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-4">
                    <span id="erreurMdp"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="cleGroupe" class="col-md-2 control-label" id="labelCle">Clé</label>
                  <div class="col-md-3">
                    <input type="password" class="form-control" id="cleGroupe" name="cleGroupe" placeholder="Clé pour accéder au groupe" maxlength="200">
                  </div>
                  <div class="col-md-1">
                    <div class="checkbox">
                      <label id="labelCheckBox">
                        <input type="checkbox" id="revelerMdp"> Révéler
                      </label>
                    </div>
                  </div>
                </div>
                <br/>
                <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-4">
                    <button type="button" class="btn btn-primary" id="btnRejoindreGroupe" name="btnCreerGroupe">Rejoindre le groupe</button>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </div>

<?php $contenu = ob_get_clean(); ?>

<?php require('./views/layout/main.php'); ?>
