<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Projet Licore</a>
    </div>

    <ul id="navbar-ul" class="nav navbar-nav">
      <?php
        if (estAccessible('mes-competences')) {
          echo '<li id="navbar-mes-competences"><a href="index.php">Mes compétences</a></li>';
        }
        if (estAccessible('valider-competences-utilisateurs')) {
          echo '<li id="navbar-valider-competences-utilisateurs"><a href="index.php?action=valider-competences-utilisateurs">Validation des compétences</a></li>';
        }
        if (estAccessible('gestion-competences')) {
          echo '<li id="navbar-gestion-competences"><a href="index.php?action=gestion-competences">Gestion des compétences</a></li>';
        }
        if (estAccessible('gestion-groupes')) {
          echo '<li id="navbar-gestion-groupes"><a href="index.php?action=gestion-groupes">Gestion des groupes</a></li>';
        }
        if (estAccessible('gestion-utilisateurs')) {
          echo '<li id="navbar-gestion-utilisateurs"><a href="index.php?action=gestion-utilisateurs">Gestion des utilisateurs</a></li>';
        }
        if (estAccessible('statistique')){
          echo '<li id="navbar-statistique"><a href="index.php?action=statistique">Statistique</a></li>';
        }
        if (estAccessible('bilan')){
          echo '<li id="navbar-bilan"><a href="index.php?action=bilan" onclick = majPage()> Bilan de compétence</a></li>';
        }
        if ((estAccessible('rejoindre-groupe')) && ($_SESSION['idGroupe'] == null)) {
          echo '<li id="navbar-rejoindre-groupe"><a href="index.php?action=rejoindre-groupe">Rejoindre un groupe</a></li>';
        }
        if ((estAccessible('mon-groupe')) && ($_SESSION['idGroupe'] != null)) {
          echo '<li id="navbar-mon-groupe"><a href="index.php?action=mon-groupe">Mon groupe</a></li>';
        }
        ?>
      </ul>
    </ul>

    <div class="navbar-right">
      <?php
        if (estConnecte()) {
          echo getPrenomUtilisateur() . ' ' . getNomUtilisateur() . ' (' . getRoleUtilisateur() . ')';
          echo '(<a href="index.php?action=deconnexion">Déconnexion</a>)';
        } else {
          echo '<a href="index.php?action=connexion"><button type="button" class="btn btn-default navbar-btn">Connexion</button></a>';
        }
      ?>
    </div>

  </div>
</nav>
