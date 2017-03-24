<?php
    require('models/fpdf.php');

    class PDF extends FPDF{
        public $prenom;
        public $nom;
        public $widths;
        public $aligns;
        public $marge = 11;
        public $sautDeLigne = 20;
        public $headerTable = array('Référence', 'Nom de la compétence', 'Date de validation');
        public $title;
        public $posYApresHeader;

        function SetWidths($w){
            $this->widths=$w;
        }

        function SetAligns($a){
            $this->aligns=$a;
        }

        function GetMarge(){
            return $this->marge;
        }

        function GetSautDeLigne(){
            return $this->sautDeLigne;
        }

        function SetTitleTable($title){
            $this->title = $title;
        }

        function getYApresHeader(){
            return $this->posYApresHeader;
        }

        function HeaderTable(){
            $this->SetFont('Arial','B', 14);
            $this->Cell($this->GetMarge());
            $this->Cell(170,9,$this->ConvertirChaine(utf8_decode($this->title)),1,1,'C',1);
            $this->SetFont('Arial','B', 9);
            $this->Cell($this->GetMarge());

            for($i=0;$i<count($this->headerTable);$i++){
                $w=$this->widths[$i];
                $this->Cell($w,7,$this->ConvertirChaine(utf8_decode($this->headerTable[$i])),1,0,'C');
            }

            $this->Ln();
            $this->SetFont('Arial','', 9);
        }

        function Row($data){
            $nb=0;

            for($i=0;$i<count($data);$i++){
                $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
            }

            $h=5*$nb;

            $this->CheckPageBreak($h);

            for($i=0;$i<count($data);$i++){
                if($i == 0){
                    $this->Cell($this->GetMarge());
                }

                $w=$this->widths[$i];
                //$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
                $x=$this->GetX();
                $y=$this->GetY();

                /*if($i == 1){
                    $this->Rect($x,$y,$w,$h);
                    $this->MultiCell($w,5,$this->ConvertirChaine(utf8_decode($data[$i])),0,$a);
                }
                else{*/
                    $this->Rect($x,$y,$w,$h);
                    $this->MultiCell($w,5,$this->ConvertirChaine(utf8_decode($data[$i])),0,'C');
                //}

                $this->SetXY($x+$w,$y);
            }

            $this->Ln($h);
        }

        function CheckPageBreak($h, $mode = 0){
            if($this->GetY()+$h>$this->PageBreakTrigger){
                $this->AddPage($this->CurOrientation);

                if($mode == 0){
                    $this->HeaderTable();
                }
            }
        }

        function testTailleTableau($data,$dataHeader){
            $hTableau = $this->CalculerHauteur($data);
            if((!$this->VerifierHauteur($data)) && ($this->getYApresHeader() + $hTableau < $this->PageBreakTrigger)){
                $this->AddPage($this->CurOrientation);
            }
            elseif(!$this->VerifierHauteur($dataHeader)){
                $this->AddPage($this->CurOrientation);
            }
        }

        function CalculerHauteur($data){
            $nb = 0;
            $nb2 = 0;
            $change = 0;

            for($i=0;$i<count($data);$i++){
                for($j=0;$j<count($data[$i]);$j++){
                    if($i != 0){
                        $nb += max($nb2,$this->NbLines($this->widths[$change],$data[$i][$j]));
                        if($change == 0){
                            $change = 1;
                        }
                        else{
                            $change = 0;
                        }
                    }
                    else{
                        $nb += max($nb2,$this->NbLines(170,$data[$i][$j]));
                    }
                }
                $nb2 = 0;
            }

            return $nb;
        }

        function VerifierHauteur($data){
            $nb = $this->CalculerHauteur($data);
            //$h=5*$nb;
            $h = $nb;

            if($this->GetY()+$h>$this->PageBreakTrigger){
                return false;
            }

            return true;
            //$this->CheckPageBreak($h,1);
        }

        function NbLines($w,$txt){
            $cw=&$this->CurrentFont['cw'];
            if($w==0)
                $w=$this->w-$this->rMargin-$this->x;
            $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
            $s=str_replace("\r",'',$txt);
            $nb=strlen($s);
            if($nb>0 and $s[$nb-1]=="\n")
                $nb--;
            $sep=-1;
            $i=0;
            $j=0;
            $l=0;
            $nl=1;
            while($i<$nb){
                $c=$s[$i];
                if($c=="\n"){
                    $i++;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                    continue;
               }
               if($c==' ')
                  $sep=$i;
               $l+=$cw[$c];
               if($l>$wmax){
                  if($sep==-1){
                      if($i==$j)
                          $i++;
                  }
                  else
                      $i=$sep+1;
                  $sep=-1;
                  $j=$i;
                  $l=0;
                  $nl++;
              }
              else
                  $i++;
        }

        return $nl;
    }

        function setPrenomEtNom($prenom, $nom){
            $this->prenom = $prenom;
            $this->nom = $nom;
        }

        function ConvertirChaine($chaine){
            return str_replace("?", "'", $chaine);
        }

        function Header(){
            $this->SetFont('Arial','B',13);
            $this->Cell(30,7,$this->ConvertirChaine(utf8_decode('Prénom : ' . $this->prenom)),0,1);
            $this->Cell(80);
            $this->Image('./images/logo_um.png',170,6,30);
            $this->Ln();
            $this->Cell(30,7,$this->ConvertirChaine(utf8_decode('Nom : ' . $this->nom)));
            $this->Ln($this->GetSautDeLigne());
            $this->Cell(82);
            $this->SetFont('Arial','B',18);
            $this->Cell(30,10,$this->ConvertirChaine(utf8_decode('Compétences Validées')),0,0,'C');
            $this->ln(30);
            $this->posYApresHeader = $this->GetY();
        }

        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }

        function afficherTableau($competencesParRacine){
            $testArray = array(array($this->title), $this->headerTable, $competencesParRacine[0]);
            $tableauTotal = array_merge(array(array($this->title), $this->headerTable),$competencesParRacine);
            $this->testTailleTableau($tableauTotal, $testArray);
            $this->HeaderTable();

            for($i=0;$i<sizeof($competencesParRacine);$i++){
                $this->Row($competencesParRacine[$i]);
            }
        }
  }

    $prenom = utf8_decode($_SESSION['prenom']);
    $nom = utf8_decode($_SESSION['nom']);
    $competences = getCompetencesValidesFeuilles();
    //$header = array('Reference', 'Nom de la compétence', 'Date de validation');

    $pdf = new PDF();
    $pdf->setPrenomEtNom($prenom, $nom);
    $pdf->SetWidths(array(30,110,30));
    $pdf->SetFillColor(231, 224, 210);
    $pdf->AliasNbPages();
    $pdf->AddPage();

    if(!empty($competences)){
        $idPereRacineCompetence = $competences[0]['idPereRacineCompetence'];
        $competencesParRacine = array();

        for($i = 0;$i < sizeof($competences);$i++){
            if($competences[$i]['idPereRacineCompetence'] != $idPereRacineCompetence){
                $title = getNomCompetence($idPereRacineCompetence);
                $pdf->SetTitleTable($title);
                $pdf->afficherTableau($competencesParRacine);
                $pdf->Ln($pdf->GetSautDeLigne());
                //$pdf->Ln(143);
                $competencesParRacine = array();
                $idPereRacineCompetence = $competences[$i]['idPereRacineCompetence'];
            }

            $competencesParRacine[] = array($competences[$i]['reference'], $competences[$i]['nomCompetence'], $competences[$i]['dateValidation']);
        }

        $title = getNomCompetence($idPereRacineCompetence);
        $pdf->SetTitleTable($title);
        $pdf->afficherTableau($competencesParRacine);
    }
    else{
        $pdf->Cell(80);
        $pdf->SetFont('Arial','I',15);
        $pdf->Cell(30,10,$pdf->ConvertirChaine(utf8_decode("Aucune compétence n'a été validée")),0,0,'C');
    }

    $nomFichier = $prenom . $nom . '-competences';

    $pdf->Output($nomFichier, 'I');
?>
