"use strict"

function majButtons(e){
  "use strict";
  $buttonSelectionne.removeClass("active"),e.addClass("active"),$buttonSelectionne=e
}

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


function genererListeCompetencesStatistique(e, n, t, o) {
    "use strict";
    var i = "",
        r = 0;
    n || r || (i += "\n<ul>\n");
    for (var c = 0, s = t.length; s > c; c++) {
        var l = t[c];
        if (e === l.idPereCompetence) {
            i += '<li id="competence-' + l.idCompetence + '"', i += "valide" === l.etat ? ' class="couleur-text-valide">' : ' class="couleur-text-lien">', i += '<a href="#" data-ref-competence="' + l.reference + '" onclick = getStatistiqueCompetences("'+l.idCompetence+'") >' + l.reference + " : " + l.nomCompetence + "</a>";
            r = n, genererListeCompetencesStatistique(l.idCompetence, n + 1, t, o)
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





function genererSelectionDeroulante(id){
  var select,option;
  var i = 0,j = 0,tab = new Array(),tab2= new Array();
  select = document.getElementById( id );
  $.ajax({
    async: false,
    dataType : 'json',
    url: "api/competences.php?type=ArbreEtudiants",
    type : 'GET',
    success: function(data){
      for(i = 0; i < data.length;i++){
        var e = data[i];
        tab[i] = e;
      }
    }
  });
  $.ajax({
    async: false,
    dataType : 'json',
    url: "api/competences.php?type=PereCompetences",
    type : 'GET',

    success: function(data2){

      console.log(data2);
      for(j = 0; j < data2.length;j++){
        var f = data2[j];
        tab2[j] = f;
      }
    }
  });
  console.log(tab.length);
  option = new Option("-Choix Etudiant-",-10);
  select.add( option );
  for ( i = 0; i < tab.length; i += 1 ) {
      option = new Option((tab[i].nom+" "+tab[i].prenom),tab[i].idEtudiant);
      select.add( option );
  }
  console.log(tab2.length);
  option = new Option("-Choix Compétence-",-10);
  select.add( option );
  for ( i = 0 ; i < tab2.length; i += 1 ) {
      option = new Option(tab2[i].nomCompetence,tab2[i].idCompetence);
      select.add( option );
  }
}

function update(id){
  var selectElmt1 = document.getElementById('Parametre2');
  selectElmt1.innerHTML = "";
  genererSelectionDeroulante('Parametre2');
}

genererSelectionDeroulante('Parametre1');

function lancerStat(id1,id2){
  var selectElmt1 = document.getElementById(id1);
  var selectElmt2 = document.getElementById(id2);
  var valeurselectionnee1 = selectElmt1.options[selectElmt1.selectedIndex].value;
  var valeurselectionnee2 = selectElmt2.options[selectElmt2.selectedIndex].value;
  var doc = document.getElementById('Statistique');
  doc.innerHTML = " ";

  if(valeurselectionnee1 != -10 && valeurselectionnee2 != -10){
    var nomCompetence = [];
    var reussite = [];
    var echec = [];
    $.getJSON( "api/competences.php",{type : "recupererStat" ,idEtudiant : valeurselectionnee1,idCompetence : valeurselectionnee2}, function( data ) {
      for(var i = 0; i<data.length;i++){

          doc.append(selectElmt1.options[selectElmt1.selectedIndex].text + ' a validé la competence "'+data[i].nomCompetence+'"avec '+data[i].valeur+'% de reussite');
          doc.append(document.createElement("br"));
          nomCompetence[i]=data[i].nomCompetence;
          if(data[i].valeur == 0){
            reussite[i] = 0;
            echec[i] = 0;
          }else{
            reussite[i]=data[i].valeur;
            echec[i]=100-data[i].valeur;
          }

        }
        $('#container').remove();
        $('iframe.chartjs-hidden-iframe').remove();
        $('#graph-container').append('<canvas id="container" style="width:80%; height:100px;"><canvas>');
        var ctx = document.getElementById('container');
        var ctx = document.getElementById('container').getContext("2d");
        var ctx = $('#container');
        var ctx = 'container';
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: nomCompetence,
                datasets: [{
                    label: 'Reussite en %',
                    data: reussite,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            hidden: null,
            scaleOverride : true,
            scaleSteps : 10,
            scaleStepWidth : 100,
            scaleStartValue : 0,
            options: {
                scales: {
                  xAxes: [{
                  stacked: true
                }],
                  yAxes: [{
                    ticks: {
                    beginAtZero:true,
                    steps: 10,
                    stepValue: 5,
                    max: 100
                    }
                  }]
                }
            }
        });
    })
  }
  else {
    $.getJSON( "api/competences.php",{type : "recupererStatCompetencesGeneral" ,idCompetence : valeurselectionnee1}, function( data ) {
      var doc = document.getElementById('Statistique');
      var nom = [];
      var reussite = [];
      var demande = [];
      var myChart = null;
      if(data != null){
        for(var i= 0 ; i < data.length;i++){
          console.log(data[i].nomCompetence);
          doc.append('La competence '+data[i].nomCompetence+ ' a été validé '+data[i].valeur + ' fois en '+data[i].demande+' demande');
          doc.append(document.createElement("br"));
          nom[i] = data[i].nomCompetence;
          if(data[i].valeur == 0){
            reussite[i] = 0;
            demande[i] = 100;
          }
          else if(data[i].demande == 0){
            reussite[i] = 0;
            demande[i] = 0;
          }
          else{
            reussite[i] = (data[i].valeur / data[i].demande) *100 ;
            demande[i] = (data[i].valeur / data[i].demande) *100;
          }
      }
      $('#container').remove();
      $('iframe.chartjs-hidden-iframe').remove();
      $('#graph-container').append('<canvas id="container" style="width:80%; height:100px;"><canvas>');
      var ctx = document.getElementById('container');
      var ctx = document.getElementById('container').getContext("2d");
      var ctx = $('#container');
      var ctx = 'container';
      var myChart = new Chart(ctx, {
          type: 'horizontalBar',
          data: {
              labels: nom,
              datasets: [{
                  label: 'Reussite en %',
                  data: reussite,
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255,99,132,1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          hidden: null,
          scaleOverride : true,
          scaleSteps : 10,
          scaleStepWidth : 100,
          scaleStartValue : 0,
          options: {
              scales: {
                xAxes: [{
                stacked: true
              }],
                yAxes: [{
                  ticks: {
                  beginAtZero:true,
                  steps: 10,
                  stepValue: 5,
                  max: 100
                  }
                }]
              }
          }
      });
      /*$(function () {
          var myChart = Highcharts.chart('container', {
              chart: {
                  type: 'bar'
              },
              title: {
                  text: 'Reussite dans les competences ' + selectElmt1.options[selectElmt1.selectedIndex].text
              },
              xAxis: {
                  categories: nom
              },
              yAxis: {
                  title: {
                      text: 'Reussite par rapport à la demande'
                  }
              },
              series: [{
                  name: 'Reussite',
                  data: reussite
              }, {
                  name: 'Demande',
                  data: demande
              }]
          });
      });*/
      }
      else if(data == null){
        doc.append('Erreur mon cher jamy');
      }
    })
    console.log("Fun");
  }
}


function majPage(id1,id2){
  var selectElmt1 = document.getElementById(id1);
  var selectElmt2 = document.getElementById(id2);
  selectElmt1.innerHTML = "";
  selectElmt2.innerHTML = "";
  genererSelectionDeroulante('Parametre1');
}
