<?php
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF

require('invoice.php');

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
// $pdf->addSociete( "MaSociete",
//                   "MonAdresse\n" .
//                   "75000 PARIS\n".
//                   "R.C.S. PARIS B 000 000 007\n" .
//                   "Capital : 18000 " . EURO );
//$pdf->fact_dev( "Devis ", "TEMPO" );
//$pdf->temporaire( "Devis temporaire" );
$date = "December 19,2015";
$invoice = "#01-150419-01";
$pdf->addDate( $date );
$pdf->addInvoice($invoice);
//$pdf->addPageNumber("1");
//$pdf->addClientAdresse("Ste\nM. XXXX\n3ème étage\n33, rue d'ailleurs\n75000 PARIS");
//$pdf->addReglement("Chèque à réception de facture");
//$pdf->addEcheance("03/12/2003");
//$pdf->addNumTVA("FR888777666");
//$pdf->addReference("Devis ... du ....");
$name="Laura Baugh";
$email="laura.baugh@himalayandogchew.com";
$post="Brand Director";
$companyName="Himalayan Dog Chew";
$streetName="4480 Chennault Beach Road";
$address="Mulkiteo, WA 98275";

$cols = array();
    $cols[0]=$name;//]=$pdf->GetStringWidth($name);
    $cols[1]=$email;//]=$pdf->GetStringWidth($email);
    $cols[2]=$post;//]=$pdf->GetStringWidth($post);
    $cols[3]=$companyName;//]=$pdf->GetStringWidth($companyName);
    $cols[4]=$streetName.",";//]=$pdf->GetStringWidth($streetName);
    $cols[5]=$address;//]=$pdf->GetStringWidth($address);
// $cols=array( $name  => $pdf->GetStringWidth($name),
//              $email  =>$pdf->GetStringWidth($email),
//              $post	=> $pdf->GetStringWidth($post),
//              $companyName  => $pdf->GetStringWidth($companyName),
//              $streetName."," => $pdf->GetStringWidth($streetName),
//              $address => $pdf->GetStringWidth($address) );
$pdf->addTo( $cols);



/*$cols=array( $name    => "R",
             $email  => "R",
             $post     => "R",
             $companyName   => "R",
             $streetName => "R",
             $address => "R" );*/
$projectName="Himalayan Dog Chew Website";

$cols=array($projectName=> $pdf->GetStringWidth($projectName));
$pdf->addFor($cols);
$cols=array($projectName=> "L" );
//$pdf->addLineFormat( $cols);
//$pdf->addLineFormat($cols);
$snHeader="S.N.";
$descHeader="Description";
$amountHeader="Amount";
$cols=array( $snHeader    => 13,
             $descHeader  => 155,
             $amountHeader=> 22);
$pdf->addCols($cols);
$cols=array( $snHeader    => "C",
             $descHeader  => "C",
             $amountHeader=> "C" );
//$pdf->addLineFormat( $cols);
//$pdf->addLineFormat($cols);

$y    = 130;
for($i=0;$i<10;$i++)
{
	$desc[$i] = "Himalayan Dog Chew Website";
	$descWeb[$i] = "www.himalayandogchew.com";
	$amount[$i] = "$2406.48";
	
	$line = array( $snHeader    => $i+1,
	               $descHeader  => $desc[$i]."(".$descWeb[$i].")",
	               $amountHeader=> $amount[$i]);
	$size = $pdf->addLine( $y, $line );
	$y   += $size + 2;
}

$totalAmount = "$2406.48";
$vat="13%";
$totalDue="$2719.32";

$pdf->addSubTotal($totalAmount);
$pdf->addVat($vat);
$pdf->addTotalDue($totalDue);


//$pdf->addCadreTVAs();
        
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte
// $tot_prods = array( array ( "px_unit" => 600, "qte" => 1, "tva" => 1 ),
//                     array ( "px_unit" =>  10, "qte" => 1, "tva" => 1 ));
// $tab_tva = array( "1"       => 19.6,
//                   "2"       => 5.5);
// $params  = array( "RemiseGlobale" => 1,
//                       "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
//                       "remise"         => 0,       // {montant de la remise}
//                       "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
//                   "FraisPort"     => 1,
//                       "portTTC"        => 10,      // montant des frais de ports TTC
//                                                    // par defaut la TVA = 19.6 %
//                       "portHT"         => 0,       // montant des frais de ports HT
//                       "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
//                   "AccompteExige" => 1,
//                       "accompte"         => 0,     // montant de l'acompte (TTC)
//                       "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
//                   "Remarque" => "Avec un acompte, svp..." );

//$pdf->addTVAs( $params, $tab_tva, $tot_prods);
//$pdf->addCadreEurosFrancs();
$pdf->Output();
?>