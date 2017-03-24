"use strict"
function genererListeCompetencesBilan(e, n, t, o) {
    "use strict";
    var i = "",
        r = 0;
    n || r || (i += "\n<ul>\n");
	
    for (var c = 0, s = t.length; s > c; ++c) {
        var l = t[c];
        if (e === l.idPereCompetence) {
            if (n > r && (i += "\n<ul>\n"), "gestionCompetences" === o) {
                var p = {
                    idCompetence: l.idCompetence,
                    nomCompetence: l.nomCompetence,
                    reference: l.reference,
                    visible: l.visible,
                    feuille: l.feuille
                };
                i += genererLigneCompetenceGestion(p, "display-normal")
            } else i += '<li id="competence-' + l.idCompetence + '"', i += "valide" === l.etat ? ' class="couleur-text-valide">' : ' class="couleur-text-lien">', i += '<a href="#" data-ref-competence="' + l.reference + '">' + l.reference + " : " + l.nomCompetence + "</a>";
            r = n, i += genererListeCompetences(l.idCompetence, n + 1, t, o)
        }
		
    }
	console.log(i);
    return i += r === n && 0 !== r ? "</ul>\n</li>\n" : r === n ? "</ul>\n" : "</li>\n"
}

function affichageCompetence(p){
	
	console.log(p);
  if(p==="bilanbouton"){
    $("#listeCompetences").empty();
    $.getJSON("api/competences.php",{type:"getCompetencesVisibles"}).always(function(e){
      "use strict";
      $("#listeCompetences").append('<a href="#" data-ref-competence="C">Liste des compétences</a>'),
      $("#listeCompetences").append(genererListeCompetencesBilan(0,0,e,"afficherCompetences"));
      majArbre("#arbreListeCompetences");
      for(var t=0,i=e.length;i>t;++t){
        var o=e[t],s={idCompetence:o.idCompetence,nomCompetence:o.nomCompetence,reference:o.reference,type:"sousCompetences"};
        $("#competence-"+o.idCompetence).find("a").first().click(s,afficherCompetence);
      }
    }
  }
}







