<?php
    function getUtilisateurs($nomUtilisateur,$type = 'normal'){
        global $bdd;
        $limite = 30;
        $ident = explode(" ",$nomUtilisateur);
        $utilisateurs = array();
        $prenom = '%' . strtoupper(trim($nomUtilisateur)) . '%';
        $nom = '%' . strtoupper(trim($nomUtilisateur)) . '%';

        if((strcmp($nomUtilisateur,$ident[0]) != 0) && (!empty(trim($ident[1])))){
            $prenom = '%'. strtoupper($ident[0]) . '%';
            $nom = '%'. strtoupper($ident[1]) . '%';

            if(strcmp($type,'groupe') == 0){
              $querySelect = $bdd->prepare("Select idUtilisateur, prenom, nom From utilisateur Where Ucase(prenom) Like :prenom and Ucase(nom) Like :nom and idRole = 3 and idGroupe is null Order by nom, prenom Limit :limite");
            }
            else{
              $querySelect = $bdd->prepare("Select idUtilisateur, prenom, nom From utilisateur Where Ucase(prenom) Like :prenom and Ucase(nom) Like :nom Order by nom, prenom Limit :limite");
            }

            $querySelect->bindParam(':prenom', $prenom , PDO::PARAM_STR);
            $querySelect->bindParam(':nom', $nom, PDO::PARAM_STR);
            $querySelect->bindParam(':limite', $limite, PDO::PARAM_INT);
            $querySelect->execute();

            while($row = $querySelect->fetch()){
              if(!array_search($row['idUtilisateur'], array_column($utilisateurs, 'idUtilisateur'))){
                $utilisateur = array(
                    'idUtilisateur' => intval($row['idUtilisateur']),
                    'prenom' => $row['prenom'],
                    'nom' => $row['nom'],
                );

                $utilisateurs[] = $utilisateur;
              }
            }

            $limite -= $querySelect->rowCount();

            if($limite > 0){
              $prenom = '%'. strtoupper($ident[1]) . '%';
              $nom = '%'. strtoupper($ident[0]) . '%';

              if(strcmp($type,'groupe') == 0){
                $querySelect = $bdd->prepare("Select idUtilisateur, prenom, nom From utilisateur Where Ucase(prenom) Like :prenom and Ucase(nom) Like :nom and idRole = 3 and idGroupe is null Order by nom, prenom Limit :limite");
              }
              else{
                $querySelect = $bdd->prepare("Select idUtilisateur, prenom, nom From utilisateur Where Ucase(prenom) Like :prenom and Ucase(nom) Like :nom Order by nom, prenom Limit :limite");
              }

              $querySelect->bindParam(':prenom', $prenom , PDO::PARAM_STR);
              $querySelect->bindParam(':nom', $nom, PDO::PARAM_STR);
              $querySelect->bindParam(':limite', $limite, PDO::PARAM_INT);
              $querySelect->execute();

              while($row = $querySelect->fetch()){
                  if(array_search($row['idUtilisateur'], array_column($utilisateurs, 'idUtilisateur')) === false){
                      $utilisateur = array(
                          'idUtilisateur' => intval($row['idUtilisateur']),
                          'prenom' => $row['prenom'],
                          'nom' => $row['nom']
                      );

                      $utilisateurs[] = $utilisateur;
                  }
              }

              $limite -= $querySelect->rowCount();
          }
        }

        if($limite > 0){
            if(strcmp($type,'groupe') == 0){
              $querySelect = $bdd->prepare("Select idUtilisateur, prenom, nom From utilisateur Where (Ucase(prenom) Like :prenom or Ucase(nom) Like :nom or Ucase(prenom) Like :prenom2 or Ucase(nom) Like :nom2) and idRole = 3 and idGroupe is null Order by nom, prenom Limit :limite");
            }
            else{
              $querySelect = $bdd->prepare("Select idUtilisateur, prenom, nom From utilisateur Where Ucase(prenom) Like :prenom or Ucase(nom) Like :nom or Ucase(prenom) Like :prenom2 or Ucase(nom) Like :nom2 Order by nom Limit :limite");
            }

            $querySelect->bindParam(':prenom', $prenom , PDO::PARAM_STR);
            $querySelect->bindParam(':nom', $nom, PDO::PARAM_STR);
            $querySelect->bindParam(':prenom2', $nom , PDO::PARAM_STR);
            $querySelect->bindParam(':nom2', $prenom, PDO::PARAM_STR);
            $querySelect->bindParam(':limite', $limite, PDO::PARAM_INT);
            $querySelect->execute();

            while($row = $querySelect->fetch()){
                if(array_search($row['idUtilisateur'], array_column($utilisateurs, 'idUtilisateur')) === false){
                    $utilisateur = array(
                        'idUtilisateur' => intval($row['idUtilisateur']),
                        'prenom' => $row['prenom'],
                        'nom' => $row['nom'],
                    );

                    $utilisateurs[] = $utilisateur;
              }
           }

           return $utilisateurs;
      }
    }

    function estRoleDeUtilisateur($idUtilisateur,$idRole){
        global $bdd;

        $querySelect = $bdd->prepare("Select idRole From utilisateur Where idUtilisateur = :idUtilisateur");
        $querySelect->bindParam(':idUtilisateur', $idUtilisateur , PDO::PARAM_INT);
        $querySelect->execute();

        return $idRole == intval($querySelect->fetchColumn());
    }

    function getRolesUtilisateur($idUtilisateur){
        global $bdd;
        $roles = array();

        $querySelect = $bdd->prepare("Select idRole, nomRole From role Order by nomRole");
        $querySelect->execute();

        while($row = $querySelect->fetch()){
            $role = array(
              'idRole' => intval($row['idRole']),
              'nomRole' => $row['nomRole'],
              'roleUtilisateur' => estRoleDeUtilisateur($idUtilisateur,$row['idRole'])
            );

            $roles[] = $role;
        }

        return $roles;
    }

    function changerRoleUtilisateur($idUtilisateur,$idRole){
        global $bdd;

        $queryUpdate = $bdd->prepare("Update utilisateur Set idRole = :idRole Where idUtilisateur = :idUtilisateur");
    		$queryUpdate->bindParam(':idRole', $idRole, PDO::PARAM_INT);
    		$queryUpdate->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    		$queryUpdate->execute();
    }

    function estUnEtudiantValide($prenom,$nom,$idUtilisateur){
        global $bdd;
        $res = false;

        $querySelect = $bdd->prepare("Select * From utilisateur Where prenom = :prenom and nom = :nom and idUtilisateur = :idUtilisateur and idRole = 3");
        $querySelect->bindParam(':prenom', $prenom , PDO::PARAM_STR);
        $querySelect->bindParam(':nom', $nom , PDO::PARAM_STR);
        $querySelect->bindParam(':idUtilisateur', $idUtilisateur , PDO::PARAM_INT);
        $querySelect->execute();

        if($querySelect->fetch()){
            $res = true;
        }

        return $res;
    }

    function getIdEtudiant($prenom,$nom){
        global $bdd;

        $querySelect = $bdd->prepare("Select idUtilisateur From utilisateur Where prenom = :prenom and nom = :nom");
        $querySelect->bindParam(':prenom', $prenom , PDO::PARAM_STR);
        $querySelect->bindParam(':nom', $nom , PDO::PARAM_STR);
        $querySelect->execute();

        $row = $querySelect->fetch();

        return array(
            'id' => intval($row['idUtilisateur'])
        );
    }

    function getNomCompletUtilisateur($idUtilisateur){
      global $bdd;

      $querySelect = $bdd->prepare("Select prenom, nom From utilisateur Where idUtilisateur = :idUtilisateur");
      $querySelect->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
      $querySelect->execute();

      $row = $querySelect->fetch();

      return $row['prenom'] . ' ' . $row['nom'];
    }
 ?>
