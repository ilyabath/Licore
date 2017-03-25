<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

function getCompetencesVisibles(){
    global $bdd;
    $competences = array();
    $querySelect = $bdd->prepare("Select idCompetence, idPereCompetence, nomCompetence, refCompetence From competence Where visible = 1 ORDER BY length(refCompetence) ASC, refCompetence ASC");
	$querySelect->execute();

    while($row = $querySelect->fetch()){
		if(!estUneFeuille($row['idCompetence'])){
            $competence = array(
              	'idCompetence' => intval($row['idCompetence']),
                'idPereCompetence' => intval($row['idPereCompetence']),
                'nomCompetence' => $row['nomCompetence'],
                'feuille' => auMoinsUneFeuilleDansLesFils($row['idCompetence']),
                'valide' => sontToutesValidesLesCompetences($row['idCompetence']),
                'reference' => $row['refCompetence']
            );

            $competences[] = $competence;
        }
    }

    return $competences;
}

function auMoinsUneFeuilleDansLesFils($idPere){
	global $bdd;
	$querySelect = $bdd->prepare("Select idCompetence From competence Where idPereCompetence = :idPere and visible = 1");
	$querySelect->bindParam(':idPere', $idPere, PDO::PARAM_INT);
	$querySelect->execute();

	while($row = $querySelect->fetch()){
		if(estUneFeuille($row['idCompetence'])){
        		return true;
        }
	}

	return false;
}

function sontToutesValidesLesCompetences($idPere){
	global $bdd;
	$querySelect = $bdd->prepare("Select idCompetence From competence Where idPereCompetence = :idPere and visible = 1");
	$querySelect->bindParam(':idPere', $idPere, PDO::PARAM_INT);
	$querySelect->execute();

	while($row = $querySelect->fetch()){
		if(estUnefeuille($row['idCompetence'])){
			if(!estCompetenceValide($row['idCompetence'])){
				return false;
			}
		}
		else{
			if(!sontToutesValidesLesCompetences($row['idCompetence'])){
				return false;
			}
		}
	}

	return true;
}

function estUneFeuille($idCompetence, $mode = 1){
	global $bdd;

	if($mode == 1){
		$querySelect = $bdd->prepare("Select * From competence Where idPereCompetence = :idCompetence and visible = 1");
	}
	else{
		$querySelect = $bdd->prepare("Select * From competence Where idPereCompetence = :idCompetence");
	}

	$querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
	$querySelect->execute();

	if($querySelect->fetch()){
		return false;
	}

	return true;
}

function estCompetenceValide($idCompetence,$idUtilisateur = 0){
	global $bdd;
  $id = $idUtilisateur;

  if($id == 0){
    if(isset($_SESSION["idUtilisateur"])){
      $id = $_SESSION['idUtilisateur'];
    }
  }

	$querySelect = $bdd->prepare("Select * From validation Where idUtilisateur = :idUtilisateur and idCompetence = :idCompetence and etat = 1");
	$querySelect->bindParam(':idUtilisateur', $id, PDO::PARAM_INT);
	$querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
	$querySelect->execute();

	if($querySelect->fetch()){
		return true;
	}

	return false;
}

function getEtatCompetence($idCompetence) {
  global $bdd;

  $querySelect = $bdd->prepare("Select etat From validation Where idUtilisateur = :idUtilisateur and idCompetence = :idCompetence");
  $querySelect->bindParam(':idUtilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
  $querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
  $querySelect->execute();

  if($querySelect->rowCount() > 0) {
    $etat = $querySelect->fetchColumn();

    if($etat == 1) {
      return "valide";
    }

    if($etat == 2){
    	return "attente";
    }

    return "invalide";
  }
  return "normal";
}

function getInformationValidation($idCompetence, $info){
	global $bdd;

    $querySelect = $bdd->prepare("Select dateValidation, nom, prenom From validation Inner Join utilisateur On validation.idTuteur = utilisateur.idUtilisateur Where idCompetence = :idCompetence and validation.idUtilisateur = :idUtilisateur");
    $querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
    $querySelect->bindParam(':idUtilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
    $querySelect->execute();

    $row = $querySelect->fetch();

    if(strcmp($info, "date") == 0){
    	return $row['dateValidation'];
    }
    elseif(strcmp($info, "nom") == 0){
    	return $row['nom'];
    }

    return $row['prenom'];
}

function getCompetencesFeuille($idPere){
	global $bdd;
	$querySelect = $bdd->prepare("Select idCompetence, nomCompetence, refCompetence From competence Where idPereCompetence = :idPere and visible = 1 ORDER BY length(refCompetence) ASC, refCompetence ASC");
	$querySelect->bindParam(':idPere', $idPere, PDO::PARAM_INT);
	$querySelect->execute();
	$competencesFeuille = array();

	while($row = $querySelect->fetch()){
		if(estUneFeuille($row['idCompetence'])){
			$competence = array(
				'idCompetence' => $row['idCompetence'],
				'nomCompetence' => $row['nomCompetence'],
        'reference' => $row['refCompetence'],
				'etat' => getEtatCompetence($row['idCompetence']),
				'dateValidation' => date('d/m/Y', strtotime(str_replace('-', '/', getInformationValidation($row['idCompetence'], "date")))),
        'prenomTuteur' => getInformationValidation($row['idCompetence'], "prenom"),
        'nomTuteur' => getInformationValidation($row['idCompetence'], "nom")
			);

			$competencesFeuille[] = $competence;
		}
	}

	return $competencesFeuille;
}

function insererExplicationEtFichier($explication,$nomFichier,$nomFichierOrigine,$idUtilisateur,$idCompetence,$idTuteur){
  global $bdd;

  if((!empty(trim($explication))) || (!is_null($nomFichier))){
    $querySelect = $bdd->prepare("Select idValidation From validation Where idUtilisateur = :idUtilisateur and idCompetence = :idCompetence");
  	$querySelect->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    $querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
  	$querySelect->execute();

    $idValidation = $querySelect->fetchColumn();
    $dateHeure = date("Y-m-d H:i:s");

    $queryInsert = $bdd->prepare("Insert into explication (date, commentaire, nomFichier, nomFichierOrigine, idTuteur, idValidation) Values (:date, :commentaire, :nomFichier, :nomFichierOrigine, :idTuteur, :idValidation)");
		$queryInsert->bindParam(':date', $dateHeure, PDO::PARAM_STR);
		$queryInsert->bindParam(':commentaire', $explication, PDO::PARAM_STR);
    $queryInsert->bindParam(':nomFichier', $nomFichier, PDO::PARAM_STR);
    $queryInsert->bindParam(':nomFichierOrigine', $nomFichierOrigine, PDO::PARAM_STR);
    $queryInsert->bindParam(':idTuteur', $idTuteur, PDO::PARAM_INT);
    $queryInsert->bindParam(':idValidation', $idValidation, PDO::PARAM_INT);
    $queryInsert->execute();
  }
}

function validerCompetence($idCompetence, $explication, $nomFichier = null, $nomFichierOrigine = null){
	global $bdd;
	$date = date("Y-m-d");

	if(strcmp(getEtatCompetence($idCompetence), "normal") == 0){
		$queryInsert = $bdd->prepare("Insert into validation (idUtilisateur, idCompetence, dateValidation, etat) Values (:idUtilisateur, :idCompetence, :dateValidation, 2)");
		$queryInsert->bindParam(':idUtilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
		$queryInsert->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
		$queryInsert->bindParam(':dateValidation', $date, PDO::PARAM_STR);
		$queryInsert->execute();
	}
	else{
		$queryUpdate = $bdd->prepare("Update validation Set dateValidation = :dateValidation, etat = 2 Where idUtilisateur = :idUtilisateur and idCompetence = :idCompetence");
		$queryUpdate->bindParam(':dateValidation', $date, PDO::PARAM_STR);
		$queryUpdate->bindParam(':idUtilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
		$queryUpdate->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
		$queryUpdate->execute();
	}

  $idUtilisateur = $_SESSION['idUtilisateur'];

  insererExplicationEtFichier($explication,$nomFichier,$nomFichierOrigine,$idUtilisateur,$idCompetence,null);
}

function invaliderCompetence($idCompetence){
	global $bdd;

	$queryDelete = $bdd->prepare("Delete From validation Where idUtilisateur = :idUtilisateur and idCompetence = :idCompetence");
	$queryDelete->bindParam(':idUtilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
	$queryDelete->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
	$queryDelete->execute();
}

function validationCompetenceParTuteur($idCompetence, $idUtilisateur){
	global $bdd;
	$idTuteur = $_SESSION['idUtilisateur'];
	$date = date("Y-m-d");

	$queryUpdate = $bdd->prepare("Update validation Set idTuteur = :idTuteur, dateValidation = :dateValidation, etat = 1 Where idUtilisateur = :idUtilisateur and idCompetence = :idCompetence");
	$queryUpdate->bindParam(':idTuteur', $idTuteur, PDO::PARAM_INT);
	$queryUpdate->bindParam(':dateValidation', $date, PDO::PARAM_STR);
	$queryUpdate->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
	$queryUpdate->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
	$queryUpdate->execute();
}

function refuserValidationCompetenceParTuteur($idCompetence,$idUtilisateur,$explication,$nomFichier,$nomFichierOrigine){
	global $bdd;
	$idTuteur = $_SESSION['idUtilisateur'];
	$date = date("Y-m-d");

	$queryUpdate = $bdd->prepare("Update validation Set idTuteur = :idTuteur, dateValidation = :dateValidation, etat = 3 Where idUtilisateur = :idUtilisateur and idCompetence = :idCompetence");
	$queryUpdate->bindParam(':idTuteur', $idTuteur, PDO::PARAM_INT);
	$queryUpdate->bindParam(':dateValidation', $date, PDO::PARAM_STR);
	$queryUpdate->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
	$queryUpdate->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
	$queryUpdate->execute();

  insererExplicationEtFichier($explication,$nomFichier,$nomFichierOrigine,$idUtilisateur,$idCompetence,$idTuteur);
}

function auMoinsUneCompetenceEstValide($idPere,$idUtilisateur = 0){
	global $bdd;
	$querySelect = $bdd->prepare("Select idCompetence From competence Where idPereCompetence = :idPere and visible = 1");
	$querySelect->bindParam(':idPere', $idPere, PDO::PARAM_INT);
	$querySelect->execute();

	while($row = $querySelect->fetch()){
		if(estUnefeuille($row['idCompetence'])){
			if(estCompetenceValide($row['idCompetence'],$idUtilisateur)){
				return true;
			}
		}
		else{
			if(auMoinsUneCompetenceEstValide($row['idCompetence'],$idUtilisateur)){
				return true;
			}
		}
	}

	return false;
}

function getCompetencesValides($idUtilisateur = 0){
	  global $bdd;
    $competencesValides = array();
    $querySelect = $bdd->prepare("Select idCompetence, idPereCompetence, nomCompetence, refCompetence From competence Where visible = 1 ORDER BY length(refCompetence) ASC, refCompetence ASC");
    $querySelect->execute();

    while($row = $querySelect->fetch()){
		if((estUneFeuille($row['idCompetence']) && estCompetenceValide($row['idCompetence'],$idUtilisateur)) || (auMoinsUneCompetenceEstValide($row['idCompetence'],$idUtilisateur))){
            $competence = array(
                'idCompetence' => intval($row['idCompetence']),
                'idPereCompetence' => intval($row['idPereCompetence']),
                'nomCompetence' => $row['nomCompetence'],
                'reference' => $row['refCompetence']
            );

            $competencesValides[] = $competence;
        }
    }

    return $competencesValides;
}

function getIdPereRacineCompetence($idCompetence){
    global $bdd;
    $querySelect = $bdd->prepare("Select idPereCompetence From competence Where idCompetence = :idCompetence");
    $querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
    $querySelect->execute();
    $idPereCompetence = $querySelect->fetchColumn();

    if($idPereCompetence != null){
        return getIdPereRacineCompetence($idPereCompetence);
    }

    return $idCompetence;
}

function compare($a, $b){
    return strnatcmp($a["reference"], $b["reference"]);
}

function getCompetencesValidesFeuilles(){
	  global $bdd;
    $competencesValides = array();
    $querySelect = $bdd->prepare("Select idCompetence, nomCompetence, refCompetence, dateValidation From competence Natural Join validation Where visible = 1 and idUtilisateur = :idUtilisateur and etat = 1 Order by length(refCompetence) ASC, refCompetence ASC");
    $querySelect->bindParam(':idUtilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
    $querySelect->execute();

    while($row = $querySelect->fetch()){
        $competence = array(
            'nomCompetence' => $row['nomCompetence'],
            'reference' => $row['refCompetence'],
            'idPereRacineCompetence' => intval(getIdPereRacineCompetence($row['idCompetence'])),
            'dateValidation' => date('d/m/Y', strtotime(str_replace('-', '/', $row['dateValidation'])))
        );

        $competencesValides[] = $competence;
    }

    usort($competencesValides, "compare");

    return $competencesValides;
}

function modifierCompetence($idCompetence, $nouveauNom, $definition, $criteres){
	global $bdd;
  $reference = '';

	if(empty(trim($nouveauNom))){
		return array(
		    'retour' => false
		);
	}

	$queryUpdate = $bdd->prepare("Update competence Set nomCompetence = :nouveauNom, definition = :definition, criteres = :criteres Where idCompetence = :idCompetence");
	$queryUpdate->bindParam(':nouveauNom', $nouveauNom, PDO::PARAM_STR);
  $queryUpdate->bindParam(':definition', $definition, PDO::PARAM_STR);
  $queryUpdate->bindParam(':criteres', $criteres, PDO::PARAM_STR);
	$queryUpdate->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
	$queryUpdate->execute();

	return array(
	  'retour' => true,
	);
}

function ajouterCompetence($idPere, $nomCompetence, $definition, $criteres){
	global $bdd;
	$idCompetence = -1;
	$visible = 1;
  $reference = "C";

	if(!empty(trim($nomCompetence))){
    if($idPere != null){
		  $querySelect = $bdd->prepare("Select visible, refCompetence From competence Where idCompetence = :idPere");
		  $querySelect->bindParam(':idPere', $idPere, PDO::PARAM_INT);
      $querySelect->execute();
      $row = $querySelect->fetch();
      $visible = $row['visible'];
      $reference = $row['refCompetence'];
    }
    else{
      $idPere = null;
    }

    if($idPere != null){
      $querySelect = $bdd->prepare("Select refCompetence From competence Where idPereCompetence = :idPere Order by length(refCompetence) DESC, refCompetence DESC Limit 1");
      $querySelect->bindParam(':idPere', $idPere, PDO::PARAM_INT);
    }
    else{
      $querySelect = $bdd->prepare("Select refCompetence From competence Where idPereCompetence is null Order by length(refCompetence) DESC, refCompetence DESC Limit 1");
    }

    $querySelect->execute();

    if($row = $querySelect->fetch()){
      $referenceDernier = $row['refCompetence'];
      $nbCaractere = strrpos($referenceDernier,".");
      $ref2 = intval(substr($referenceDernier,$nbCaractere+1)) + 1;
      if($idPere != null){
        $nouvelleRef = $reference . "." . $ref2;
      }
      else{
        $nouvelleRef = $reference . $ref2;
      }
    }
    else{
      if($idPere != null){
        $nouvelleRef = $reference . ".1";
      }
      else{
        $nouvelleRef = $reference . "1";
      }
    }

		$queryInsert = $bdd->prepare("Insert into competence (nomCompetence, definition, criteres, idPereCompetence, refCompetence, visible) Values (:nomCompetence, :definition, :criteres, :idPereCompetence, :reference, :visible)");
		$queryInsert->bindParam(':nomCompetence', $nomCompetence, PDO::PARAM_STR);
    $queryInsert->bindParam(':definition', $definition, PDO::PARAM_STR);
    $queryInsert->bindParam(':criteres', $criteres, PDO::PARAM_STR);
		$queryInsert->bindParam(':idPereCompetence', $idPere, PDO::PARAM_INT);
    $queryInsert->bindParam(':reference', $nouvelleRef, PDO::PARAM_STR);
		$queryInsert->bindParam(':visible', $visible, PDO::PARAM_INT);
		$queryInsert->execute();
		$idCompetence = $bdd->lastInsertId();
	}

	return array(
    'idCompetence' => intval($idCompetence),
    'nomCompetence' => $nomCompetence,
    'reference' => $nouvelleRef,
    'visible' => estVisible($visible)
  );
}

function ajouterPlusieursCompetences($idPere, $nomsCompetences) {
	$tableauCompetences = preg_split("/\r\n|\n|\r/", $nomsCompetences);
	$competencesAjoutees = array();
  $nomCompetence;
  $definition;
  $criteres;
  $i = 0;

	foreach ($tableauCompetences as $competence) {
      if($i == 0){
        $nomCompetence = $competence;
        $i++;
      }
      else{
        if($i == 1){
          $definition = $competence;
          $i++;
        }
        else{
          $criteres = "";
          $tabCriteres = explode("*", $competence);

          for($i=0;$i < sizeof($tabCriteres);$i++){
            $criteres = $criteres . $tabCriteres[$i] . chr(10);
          }

          $competencesAjoutees[] = ajouterCompetence($idPere, $nomCompetence, $definition, $criteres);
          $i = 0;
        }
      }
	}

	return $competencesAjoutees;
}

function estVisible($visible){
	if($visible == 1){
		return true;
	}

	return false;
}

function getToutesLesCompetences($mode){
	global $bdd;
    $competences = array();

    if(strcmp($mode, "visibles") == 0){
    	$querySelect = $bdd->prepare("Select idCompetence, idPereCompetence, nomCompetence, refCompetence From competence Where visible = 1 ORDER BY length(refCompetence) ASC, refCompetence ASC");
    }
    else{
    	$querySelect = $bdd->prepare("Select idCompetence, idPereCompetence, nomCompetence, refCompetence, visible From competence ORDER BY length(refCompetence) ASC, refCompetence ASC");
    }

    $querySelect->execute();

    while($row = $querySelect->fetch()){
    	if(strcmp($mode, "visibles") == 0){
        	$competence = array(
            	'idCompetence' => intval($row['idCompetence']),
            	'idPereCompetence' => intval($row['idPereCompetence']),
            	'nomCompetence' => $row['nomCompetence'],
              'reference' => $row['refCompetence'],
            	'feuille' => estUnefeuille($row['idCompetence']),
        	);
        }else{
        	$competence = array(
            	'idCompetence' => intval($row['idCompetence']),
            	'idPereCompetence' => intval($row['idPereCompetence']),
            	'nomCompetence' => $row['nomCompetence'],
              'reference' => $row['refCompetence'],
            	'feuille' => estUnefeuille($row['idCompetence'], 2),
            	'visible' => estVisible($row['visible'])
        	);
        }

        $competences[] = $competence;
    }

    return $competences;
}

function supprimerCompetence($idCompetence){
	global $bdd;

	if(!estUneFeuille($idCompetence)){
		$querySelect = $bdd->prepare("Select idCompetence From competence Where idPereCompetence = :idCompetence");
		$querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
		$querySelect->execute();

		while($row = $querySelect->fetch()){
			supprimerCompetence($row['idCompetence']);
		}
	}

	$queryDelete = $bdd->prepare("Delete From competence Where idCompetence = :idCompetence");
	$queryDelete->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
	$queryDelete->execute();
}

function getNomCompetence($idCompetence){
	global $bdd;

	$querySelect = $bdd->prepare("Select nomCompetence From competence Where idCompetence = :idCompetence");
	$querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
	$querySelect->execute();

	return $querySelect->fetchColumn();
}

function setCompetencesInvisibles($idCompetence){
	global $bdd;
	$competences = array();

	$queryUpdate = $bdd->prepare("Update competence Set visible = 0 Where idCompetence = :idCompetence");
	$queryUpdate->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
	$queryUpdate->execute();

	$competences[] = array(
            				'idCompetence' => intval($idCompetence),
            				'nomCompetence' => getNomCompetence($idCompetence)
    				 );

	if(!estUneFeuille($idCompetence)){
		$querySelect = $bdd->prepare("Select idCompetence From competence Where idPereCompetence = :idCompetence and visible = 1");
		$querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
		$querySelect->execute();

		while($row = $querySelect->fetch()){
			$competences = array_merge($competences, setCompetencesInvisibles($row['idCompetence']));
		}
	}

	return $competences;
}

function setCompetencesVisibles($idCompetence){
    global $bdd;
    $competences = array();

    $queryUpdate = $bdd->prepare("Update competence Set visible = 1 Where idCompetence = :idCompetence");
	$queryUpdate->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
	$queryUpdate->execute();

	$competences[] = array(
            				'idCompetence' => intval($idCompetence),
            				'nomCompetence' => getNomCompetence($idCompetence)
    				 );

	$querySelect = $bdd->prepare("Select idPereCompetence From competence Where idCompetence = :idCompetence");
	$querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
	$querySelect->execute();

	if(!empty($idPere = $querySelect->fetchColumn())){
		$querySelect = $bdd->prepare("Select visible From competence Where idCompetence = :idPere");
		$querySelect->bindParam(':idPere', $idPere, PDO::PARAM_INT);
		$querySelect->execute();

		if(!$querySelect->fetchColumn()){
			$competences = array_merge($competences, setCompetencesVisibles($idPere));
		}
	}

	/*if(!estUneFeuille($idCompetence, 2)){
		$querySelect = $bdd->prepare("Select idCompetence From competence Where idPereCompetence = :idCompetence and visible = 0");
		$querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
		$querySelect->execute();

		while($row = $querySelect->fetch()){
			$competences = array_merge($competences, setCompetencesVisibles($row['idCompetence']));
		}
	}*/

	return $competences;
}

function getUtilisateursCompetence($idCompetence) {
	global $bdd;
	$utilisateurs = array();

  $listIdGroupe = getGroupesUtilisateur();

  if(($_SESSION['idRole'] == 2) || ($_SESSION['idRole'] == 4)){
    for($i=0;$i < sizeof($listIdGroupe);$i++){
	    $querySelect = $bdd->prepare("Select idUtilisateur, nom, prenom From utilisateur Natural Join validation Where idCompetence = :idCompetence and etat = 2 and idGroupe = :idGroupe");
	    $querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
      $querySelect->bindParam(':idGroupe', $listIdGroupe[$i], PDO::PARAM_INT);
	    $querySelect->execute();

      while($row = $querySelect->fetch()){
        $utilisateur = array(
          'idUtilisateur' => $row['idUtilisateur'],
          'prenom' => $row['prenom'],
          'nom' => $row['nom']
        );

        $utilisateurs[] = $utilisateur;
      }
    }
  }
  else{
    $querySelect = $bdd->prepare("Select idUtilisateur, nom, prenom From utilisateur Natural Join validation Where idCompetence = :idCompetence and etat = 2");
    $querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
    $querySelect->execute();

    while($row = $querySelect->fetch()){
      $utilisateur = array(
        'idUtilisateur' => $row['idUtilisateur'],
        'prenom' => $row['prenom'],
        'nom' => $row['nom']
      );

      $utilisateurs[] = $utilisateur;
    }
  }

  return $utilisateurs;
}

function auMoinsUneFeuilleEstInvisible($idPere){
	global $bdd;
	$querySelect = $bdd->prepare("Select idCompetence, visible From competence Where idPereCompetence = :idPere");
	$querySelect->bindParam(':idPere', $idPere, PDO::PARAM_INT);
	$querySelect->execute();

	while($row = $querySelect->fetch()){
		if(estUnefeuille($row['idCompetence'],2)){
			if($row['visible'] == 0){
				return true;
			}
		}
		else{
			if(($row['visible'] == 0) || (auMoinsUneFeuilleEstInvisible($row['idCompetence']))){
				return true;
			}
		}
	}

	return false;
}

function getCompetencesInvisibles(){
	global $bdd;
	$competences = array();
    $querySelect = $bdd->prepare("Select idCompetence, idPereCompetence, nomCompetence, refCompetence, visible From competence ORDER BY length(refCompetence) ASC, refCompetence ASC");
	$querySelect->execute();

    while($row = $querySelect->fetch()){
    	if(($row['visible'] == 0) || (!estUneFeuille($row['idCompetence']) && auMoinsUneFeuilleEstInvisible($row['idCompetence']))){
    		$competence = array(
            	'idCompetence' => intval($row['idCompetence']),
            	'idPereCompetence' => intval($row['idPereCompetence']),
            	'nomCompetence' => $row['nomCompetence'],
              'reference' => $row['refCompetence'],
            	'feuille' => estUnefeuille($row['idCompetence'], 2),
            	'visible' => estVisible($row['visible'])
        	);

        	$competences[] = $competence;
    	}
    }

    return $competences;
}

function getGroupesUtilisateur(){
  global $bdd;
  $listIdGroupe = array();

  if($_SESSION['idRole'] == 2){
    $querySelect = $bdd->prepare("Select idGroupe From groupe Where idTuteur = :idTuteur");
  	$querySelect->bindParam(':idTuteur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
  	$querySelect->execute();

    while($row = $querySelect->fetch()){
      $listIdGroupe[] = intval($row['idGroupe']);
    }
  }
  elseif($_SESSION['idRole'] == 4){
    $querySelect = $bdd->prepare("Select idGroupe From groupe Where idEncadrant = :idEncadrant");
    $querySelect->bindParam(':idEncadrant', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
    $querySelect->execute();

    while($row = $querySelect->fetch()){
      $listIdGroupe[] = intval($row['idGroupe']);
    }
  }

  return $listIdGroupe;
}

function aUneDemandeDeValidation($idCompetence,$listIdGroupe){
  global $bdd;

	if(estUnefeuille($idCompetence)){
    if(is_null($listIdGroupe)){
      $querySelect = $bdd->prepare("Select * From validation Natural Join utilisateur Where idCompetence = :idCompetence and etat = 2 and idUtilisateur != :idUtilisateur" );
      $querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
      $querySelect->bindParam(':idUtilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
      $querySelect->execute();

      if($querySelect->fetch()){
        return true;
      }
    }
    else{
      for($i=0;$i < sizeof($listIdGroupe);$i++){
  		  $querySelect = $bdd->prepare("Select * From validation Natural Join utilisateur Where idCompetence = :idCompetence and etat = 2 and idUtilisateur != :idUtilisateur and idGroupe = :idGroupe" );
  		  $querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
  		  $querySelect->bindParam(':idUtilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
        $querySelect->bindParam(':idGroupe', $listIdGroupe[$i], PDO::PARAM_INT);
        $querySelect->execute();

      	if($querySelect->fetch()){
      		return true;
      	}
      }
    }
	}
	else{
		$querySelect = $bdd->prepare("Select idCompetence From competence Where idPereCompetence = :idCompetence and visible = 1 ORDER BY length(refCompetence) ASC, refCompetence ASC");
		$querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
    $querySelect->execute();

    	while($row = $querySelect->fetch()){
    		if(aUneDemandeDeValidation($row['idCompetence'],$listIdGroupe)){
    			return true;
    		}
    	}
	}

	return false;
}



function getCompetencesValidation(){
	global $bdd;
  $competences = array();

  if($_SESSION["idRole"] == 1){
    $listIdGroupe = null;
  }
  else{
    $listIdGroupe = getGroupesUtilisateur();
  }


 	$querySelect = $bdd->prepare("Select idCompetence, idPereCompetence, nomCompetence, refCompetence From competence Where visible = 1 ORDER BY length(refCompetence) ASC, refCompetence ASC");
  $querySelect->execute();

    while($row = $querySelect->fetch()){
    	if(aUneDemandeDeValidation($row['idCompetence'],$listIdGroupe)){
        	$competence = array(
            	'idCompetence' => intval($row['idCompetence']),
            	'idPereCompetence' => intval($row['idPereCompetence']),
            	'nomCompetence' => $row['nomCompetence'],
              'reference' => $row['refCompetence'],
            	'feuille' => estUnefeuille($row['idCompetence'])
        	);

        	$competences[] = $competence;
      }
    }

    return $competences;
}

function getExplications($idCompetence,$idUtilisateur = 0){
	global $bdd;
  $explications = array();

  if($idUtilisateur == 0){
    $idUtilisateur = $_SESSION['idUtilisateur'];
  }

	$querySelect = $bdd->prepare("Select date, commentaire, ex.nomFichier, nomFichierOrigine, ex.idTuteur From validation va Inner Join explication ex On va.idValidation = ex.idValidation Where idCompetence = :idCompetence and idUtilisateur = :idUtilisateur Order by date");
	$querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
	$querySelect->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
  $querySelect->execute();

  while($row = $querySelect->fetch()){
    $dateHeure = explode(" ",$row['date']);
    $date = date('d/m/Y', strtotime(str_replace('-', '/',$dateHeure[0])));
    $heure = $dateHeure[1];
    $explication = array(
  		'date' => $date,
      'heure' => $heure,
  		'commentaire' => $row['commentaire'],
      'nomFichier' => $row['nomFichier'],
      'nomFichierOrigine' => $row['nomFichierOrigine'],
      'idTuteur' => $row['idTuteur']
  	);

    $explications[] = $explication;
  }

  return $explications;
}

function estUneCompetenceFeuille($reference){
  global $bdd;

	$querySelect = $bdd->prepare("Select idCompetence From competence Where refCompetence = :reference and visible = 1");
	$querySelect->bindParam(':reference', $reference, PDO::PARAM_STR);
  $querySelect->execute();

  $res = false;

  if($querySelect->fetch()){
    $res = true;
  }

  return array(
    'res' => $res
  );
}

function getCriteresEtDefinitionCompetence($idCompetence){
  global $bdd;

  $querySelect = $bdd->prepare("Select definition, criteres From competence Where idCompetence = :idCompetence");
	$querySelect->bindParam(':idCompetence', $idCompetence, PDO::PARAM_INT);
  $querySelect->execute();

  $row = $querySelect->fetch();

  return array(
    'definition' => $row['definition'],
    'criteres' => $row['criteres']
  );
}

function recupererArbreEtudiants(){
  global $bdd;
  $arrayStudents =  array();
  $querySelect = $bdd->prepare("Select idUtilisateur,nom , prenom From utilisateur Natural Join role Where nomRole = 'Etudiant' ");
  $querySelect->execute();
  while($row = $querySelect->fetch()){
    $arrayStudent = array(
      'idEtudiant' => $row['idUtilisateur'],
      'nom' => $row['nom'],
      'prenom' => $row['prenom']
    );
    $arrayStudents[] = $arrayStudent;
  }
  return $arrayStudents;
}

function getCompetencesPere(){
  global $bdd;
  $competences = array();
  $querySelect =  $bdd->prepare("Select idCompetence,nomCompetence,idPereCompetence From competence Where idPereCompetence is NULL ");
  $querySelect->execute();
  while($row = $querySelect->fetch()){
      $competence = array(
          'idCompetence' => intval($row['idCompetence']),
          'nomCompetence' => $row['nomCompetence'],
          'idPereCompetence' => $row['idPereCompetence']
        );
        $competences[] = $competence;
    }
    return $competences;
}

function recupererStatCompetencesGeneral($idPere){
  global $bdd;
  $querySelect = $bdd->prepare("Select idCompetence, nomCompetence, refCompetence From competence Where idPereCompetence = :idPere and visible = 1 ORDER BY length(refCompetence) ASC, refCompetence ASC");
	$querySelect->bindParam(':idPere', $idPere, PDO::PARAM_INT);
	$querySelect->execute();
  $resultats = array();

	while($row = $querySelect->fetch()){
    $valeur= $bdd->prepare("Select Count(*) as valeur From validation Where idCompetence = :idCompetence AND etat = 1");
    $valeur->bindParam(':idCompetence',$row['idCompetence'],PDO::PARAM_STR);
    $demande = $bdd->prepare("Select Count(*) as demande From validation where idCompetence = :idCompetence");
    $demande->bindParam(':idCompetence',$row['idCompetence'],PDO::PARAM_STR);
    $valeur->execute();
    $demande->execute();
    $row2 = $valeur->fetch();
    $row3 = $demande->fetch();
    if($row2['valeur'] == null){
      $row2['valeur'] = 0;
    }
    if($row3['demande'] == null){
      $row3['demande'] = 0;
    }
    $resultat = array(
      'nomCompetence' => $row['nomCompetence'],
      'valeur' => $row2['valeur'],
      'demande' => $row3['demande']
    );
    $resultats[] = $resultat;
	}
  return $resultats;
}



function recupererStatEleveCompetence($idEtudiant,$idCompetence){
  global $bdd;
  $querySelect = $bdd->prepare("Select idCompetence, nomCompetence, refCompetence From competence Where idPereCompetence = :idPere and visible = 1 ORDER BY length(refCompetence) ASC, refCompetence ASC");
	$querySelect->bindParam(':idPere', $idCompetence, PDO::PARAM_INT);
	$querySelect->execute();
  $resultats = array();
  while($row = $querySelect->fetch()){
    $val1 = $bdd->prepare("SELECT COUNT(*) FROM validation WHERE idUtilisateur = :idEtudiant and idCompetence = :idCompetence");
    $val2 = $bdd->prepare("Select Count(*) From validation Where etat = 1 AND idCompetence = :idCompetence AND idUtilisateur = :idEtudiant");
    $val1->bindParam(':idCompetence', $row['idCompetence'], PDO::PARAM_STR);
    $val1->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
    $val2->bindParam(':idCompetence', $row['idCompetence'], PDO::PARAM_STR);
    $val2->bindParam(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
    $val1->execute();
    $val2->execute();
    $res1 = $val1->fetchColumn();
    $res2 = $val2->fetchColumn();
    if($res1 == 0){
      $resultat = array(
        'nomCompetence' => $row['nomCompetence'],
        'valeur' => 0
      );
      $resultats[] = $resultat;
    }
    else{
      $resultat = array(
        'nomCompetence' => $row['nomCompetence'],
        'valeur' => ($res2/$res1) * 100
      );
      $resultats[] = $resultat;
    }
  }
  return $resultats;
}




?>
