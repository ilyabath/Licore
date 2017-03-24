<form class="form-horizontal" id="creerGroupe" method="post">
  <div class="form-group">
    <label for="nomGroupe" class="col-sm-2 control-label">Nom</label>
    <div class="col-sm-3">
      <input type="text" required class="form-control" id="nomGroupe" name="nomGroupe" placeholder="Nom du groupe" maxlength="200">
    </div>
  </div>
  <div class="form-group">
    <label for="cleGroupe" class="col-sm-2 control-label">Clé</label>
    <div class="col-sm-3">
      <input required type="password" class="form-control" id="cleGroupe" name="cleGroupe" placeholder="Clé pour accéder au groupe" maxlength="200">
    </div>
    <div class="col-sm-1">
      <div class="checkbox">
        <label id="labelCheckBox">
          <input type="checkbox" id="revelerMdp"> Révéler
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="tailleGroupe" class="col-sm-2 control-label">Taille</label>
    <div class="col-sm-1">
      <input required type="number" class="form-control" id="tailleGroupe" name="tailleGroupe" value="25" min="1" max="99">
    </div>
  </div>
  <div class="form-group">
    <label for="listeComposante" class="col-sm-2 control-label">Composante</label>
    <div class="col-sm-3">
      <select required class="form-control" id="listeComposante" name="listeComposante">
        <option value="" disabled selected hidden>Choisir une composante</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="listeTuteur" class="col-sm-2 control-label">Tuteur</label>
    <div class="col-sm-3">
      <select required class="form-control" id="listeTuteur" name="listeTuteur">
        <option value="" disabled selected hidden>Choisir un tuteur</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="listeEncadrant" class="col-sm-2 control-label">Enseignant</label>
    <div class="col-sm-3">
      <select required class="form-control" id="listeEncadrant" name="listeEncadrant">
        <option value="" disabled selected hidden>Choisir un enseignant</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-4">
      <button type="submit" class="btn btn-primary" id="btnCreerGroupe" name="btnCreerGroupe">Créer le groupe</button>
    </div>
  </div>
</form>
