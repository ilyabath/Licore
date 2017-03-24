<?php

?>



      <div class="container">
      <div class="row">
            <div id="col-liste-competences" class="col-md-4">
         <!-- include(DOC_ROOT_PATH . '/views/accueil/liste-competences.php'); -->
        <div class="panel panel-default">
    <div class="panel-heading">
        <div class="text-small-caps">Liste des compétences</div>
	  </div>

    <div class="panel-body">
      <div id="loader-competences" style="display: none;">
        <img class="center" src="./images/loader.gif" alt="Chargement">
        <p class="center-text-loader">Chargement des compétences ...</p>
      </div>
      <div class="form-inline espace">
        <input id="search-bar-competence" class="input-md form-control" placeholder="Recherche d'une compétence par référence" type="search">
        <span id="search-competence" data-toggle="tooltip" data-placement="top" title="" class="glyphicon glyphicon-search cursor-pointer" aria-hidden="true" data-original-title="Lancer la recherche d'une compétence"></span>
      </div>
      <ul id="arbreListeCompetences" class="treeview treeview-tree" style="display: block;">
        <li id="listeCompetences" class="tree-branch"><script src="./dist/jquery.upload-1.0.2.min.js"></script>
		<i class="tree-indicator glyphicon glyphicon-chevron-right"></i>
	
		</i><a href="#" data-ref-competence="C">Liste des compétences</a> 
<ul>

<li id="competence-67" class="couleur-text-lien" style="display: none;"><a href="#" data-ref-competence="C1">C1 : Compétences de production de l’oral</a></li>
<li id="competence-69" class="couleur-text-lien" style="display: none;"><a href="#" data-ref-competence="C2">C2 : Compétences de production de l’écrit</a></li>
<li id="competence-75" class="couleur-text-lien" style="display: none;"><a href="#" data-ref-competence="C3">C3 : Compétences de compréhension de l’oral</a></li>
<li id="competence-76" class="couleur-text-lien" style="display: none;"><a href="#" data-ref-competence="C4">C4 : Compétences de compréhension de l’écrit</a></li>
<li id="competence-77" class="couleur-text-lien" style="display: none;"><a href="#" data-ref-competence="C5">C5 : Compétences d’interaction à l’oral</a></li>
<li id="competence-104" class="couleur-text-lien" style="display: none;"><a href="#" data-ref-competence="C6">C6 : Compétences d’interaction à l’écrit</a></li>
<li id="competence-107" class="couleur-text-lien" style="display: none;"><a href="#" data-ref-competence="C7">C7 : Compétences linguistiques</a></li>
</ul>
</li>
      </ul>
	 
    </div>
</div>
    </div>
	

    <div id="col-competences-a-valider" class="col-md-4">
        <!-- include(DOC_ROOT_PATH . '/views/accueil/competences-a-valider.php'); -->
        <div class="panel panel-default">
    <div class="panel-heading">
      <div class="text-small-caps">Compétences de l'étudiant</div>
    </div>
    <div id="panel-body-competences" class="panel-body">Veuillez cliquer sur une catégorie dans l'arbre de gauche.
    </div>
</div>
    </div>

    <div id="col-competences-validees" class="col-md-4">
         <!-- include(DOC_ROOT_PATH . '/views/accueil/liste-competences-validees.php'); -->
        <div class="panel panel-default">
  <div class="panel-heading">
    <span class="text-small-caps">Liens vers Umtice</span>

          
        
        
        
        
      </div>
      

  <div id="panel-body-competences-validees" class="panel-body">
          <div id="loader-competences-validees" style="display: none;">
        <img class="center" src="./images/loader.gif" alt="Chargement">
        <p class="center-text-loader">Chargement des compétences ...
        </p>
      </div>
      <ul id="arbreListeCompetencesValidees" class="treeview" style="display: block;"></ul>
      <p>Aucunes compétences validées</p></div>
</div>
    </div>
      </div>
    </div>
	<div class="modal fade" id="creditsModal" tabindex="-1" role="dialog" aria-labelledby="creditsModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="creditsModalLabel">Crédits</h4>
      </div>
      <div class="modal-body">
        <p>Le projet Licore est inclus dans le projet pédagogique IPURE (Innovation en Pédagogie Universitaire pour la Réussite Étudiante).
          Le but de ce projet est d'aider les étudiants à travailler les compétences requises pour réussir leurs parcours universitaires.
          Les étudiants ont ainsi accès à un bilan numérique de compétences pour leur permettre de suivre les aptitudes qu’ils ont acquises et celles qu’ils leur reste à valider pendant leur cursus.</p>
        <p>Ce site a été réalisé en 2016 par trois étudiants en Master 1 ISI à l'Université du Maine :</p>
        <ul>
          <li>Corentin Delorme (IHM, CSS et Javascript)</li>
          <li>Loïc Guenver (IHM, CSS et Javascript)</li>
          <li>Ronan Yzeux (Base de données et requêtes)</li>
        </ul>
        <a href="mailto:?to=corentin.delorme.etu@univ-lemans.fr,loic.guenver.etu@univ-lemans.fr,ronan.yzeux.etu@univ-lemans.fr">Nous contacter</a>
        <div class="text-center">
          <a href="http://iicc.univ-lemans.fr/"><img src="./images/logo_iicc.png" alt="Logo Institut Informatique Claude Chappe"></a>
          <a href="http://ipure.univ-lemans.fr/fr/"><img src="./images/logo_ipure.png" alt="Logo IPURE"></a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
<footer>
  <div class="container-fluid">
    <p class="text-muted">
      </p><div class="row-fluid">
        <div class="col-md-4">
          <p>
            <a href="#" data-toggle="modal" data-target="#creditsModal">Crédits</a>
          </p>
        </div>
        <div class="col-md-8">
          <a href="http://www.univ-lemans.fr/"><img class="logo" src="./images/logo_um.png" alt="Logo Université du Maine"></a>
          <a href="http://u-bretagneloire.fr/"><img class="logo" src="./images/logo_ubl.png" alt="Logo Université Bretagne Loire"></a>
          <a href="http://www.paysdelaloire.fr/"><img class="logo" src="./images/logo_pays_de_la_loire.png" alt="Logo Pays de la Loire"></a>
        </div>
      </div>
    <p></p>
  </div>
</footer>
<script src="./dist/jquery-1.11.3.min.js"></script>
<script src="./dist/bootstrap.min.js"></script>
<script src="./dist/bundle.min.js"></script>
<script src="./dist/bilan.js"></script>
<script src="./dist/jquery.upload-1.0.2.min.js"></script>

</html>





<?php $contenu = ob_get_clean(); ?>

<?php require('./views/layout/main.php'); ?>
