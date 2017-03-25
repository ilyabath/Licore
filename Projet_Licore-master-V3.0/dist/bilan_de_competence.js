"use strict"

function getArbreEtudiant(){
  console.log("Passage");

  $.getJSON( "api/competences.php?type=ArbreEtudiants", function( data ) {
    $("#listeCompetences").empty(),
    console.log(data),
    updateListeEtudiant(data);
  })
}

function getStatEtudiant(s){
  $.getJSON("api/competences.php?type=StatistiqueEtudiant",{s},function(data){
    console.log("uVBMEZRIUBVMibvrblq bv");
  })
}


function genererListeCompetencesDuBilan(e, n, t, o) {
    "use strict";
    var i = "",
        r = 0;
    var verif = '<FORM> <INPUT type="checkbox" name="choix1" value="1"> Je maîtrise le sujet  <INPUT type="checkbox" name="choix2" value="2"> Je maîtrise moyennement mon sujet  <INPUT type="checkbox" name="choix3" value="3">Mon niveau est insuffisant<INPUT type="checkbox" name="choix4" value="4"> Need help</FORM>';
    n || r || (i += "\n<ul>\n");
    for (var c = 0, s = t.length; s > c; ++c) {
        var l = t[c];
        if (l.feuille === true) {
          console.log(l.reference);
            i += '<li id="competence-' + l.idCompetence + '"', i += "valide" === l.etat ? ' class="couleur-text-valide">' : ' class="couleur-text-lien">', i += '<a href="#" data-ref-competence="' + l.reference + '">' + l.reference + " : " + l.nomCompetence + "</a>" + verif;
            r = n;
        }
    }
    return i += r === n && 0 !== r ? "</ul>\n</li>\n" : r === n ? "</ul>\n" : "</li>\n";

}

function genererListeEtudiant(p){
  var i = "",e;
  for(var c = 0 ; c < p.length ; c++){
    e = p[c];
    i += '<li id="etudiant-'+e.idEtudiant+'" class="couleur-text-lien">', i += '<a href="#" onclick=getStatEtudiant("'+e.idEtudiant+'")>' + e.nom +" "+ e.prenom + "</a>";
  }
  console.log(i);
  return i ;
}

function majAffichageBilan(p){
  console.log(p);
  $.getJSON("api/competences.php",{type:"getCompetencesVisibles"}).always(function(e){
    "use strict";
    $("#listeCompetences").append(genererListeCompetencesDuBilan(0,0,e,"afficherCompetences"));

    for(var t=0,i=e.length;i>t;++t){
      var o=e[t],s={idCompetence:o.idCompetence,nomCompetence:o.nomCompetence,reference:o.reference,type:"sousCompetences"};
      $("#competence-"+o.idCompetence).find("a").first().click(s,afficherCompetence);
    }
  })
  majArbre("#arbreListeCompetences");
}


function getStatistiqueCompetences() {
  console.log("Bonjour6516165310");
  $.getJSON( "api/competences.php?type=recupererStatCompetences", function( data ) {

    console.log(4);
  })

}
