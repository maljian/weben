<?php
session_start();
require_once('class.einzahlungsschein.php');
require_once('../../fpdf/fpdf.php');
date_default_timezone_set("Europe/Zurich");
$timestamp=time();
$date= date("d.m.Y",$timestamp);
$number=$_POST['number'];
$email = $_SESSION['email'];

require '../../database.php';

$pdo = Database::connect();
    $pdo->exec('set names utf8');
    $sql = "SELECT * FROM fh where Email = '$email'";
    $q = $pdo->prepare($sql);
    $q->execute();
    $data = $q->fetch(PDO::FETCH_ASSOC);
    
if($number == 10){
    $return = floatval(500.00);
}if($number == 20){
    $return = floatval(1000.00);
}if($number == 30){
    $return = floatval(1400.00);
}if($number == 40){
    $return = floatval(1800.00);
}
      
$amount = $return;
$ref = "3000000000"+$data["id"];

//Create a new pdf to create your invoice, already using FPDF
//(if you don't understand this part you should have a look at the FPDF documentation)
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetAutoPageBreak(0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(190, 4, "","T", 1);
$pdf->Cell(50, 10, "",0, 1);
$pdf->Cell(50, 4, "FH Portal",0,1);
$pdf->Cell(50, 4, "Von-Roll-Str. 10",0, 1);
$pdf->Cell(50, 4, "4600 Olten", 0,1);
$pdf->Cell(50, 10, "",0, 1);
$pdf->Cell(50, 4, $data['institution'],0, 1);
$pdf->Cell(50, 4, $data['partner'],0, 1);
$pdf->Cell(50, 4, $data['street'],0, 1);
$pdf->Cell(50, 4, $data['postalcode']." ".$data['city'],0, 1);
$pdf->Cell(50, 10, "",0, 1);
$pdf->Cell(190, 4, "","T", 1);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(100, 4, "FH Portal Rechnungsnummer: ".$ref,0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(91, 4, $date,0,1,'R');
$pdf->Cell(50, 10, "",0, 1);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(100, 4, "Sehr geehrte/r Frau/Herr ".$data['partner'],0,1);
$pdf->Cell(50, 4, "",0, 1);
$pdf->MultiCell(190, 4, "Sie haben auf dem FH Portal ".$number." Kurse gebucht. Bitte begleichen Sie den Betrag von CHF ".$amount." innerhalb der n".chr(228)."chsten vier Wochen.",0, 1);
$pdf->Cell(50, 4, "",0, 1);
$pdf->Cell(190, 4, "Bitte verwenden Sie zur ".chr(220)."berweisung den beigef".chr(252)."gten Einzahlungsschein.",0, 1);
$pdf->Cell(50, 10, "",0, 1);
$pdf->Cell(50, 10, "",0, 1);
$pdf->Cell(50, 10, "",0, 1);
$pdf->Cell(50, 10, "",0, 1);
$pdf->Cell(50, 4, "Freundliche Gr".chr(252)."sse",0, 1);
$pdf->Cell(50, 10, "",0, 1);
$pdf->Cell(50, 4, "Ihr FH Portal",0, 1);
$pdf->Cell(50, 10, "",0, 1);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 4, "Diese Rechnung wurde maschinell erstellt und ist daher ohne Unterschrift g".chr(252)."ltig.",0, 1);

//now simply include your Einzahlungsschein, sending your pdf instance to the Einzahlungsschein class
$ezs = new Einzahlungsschein(196, 0, $pdf);
$ezs->setBankData("Berner Kantonalbank AG", "3001 Bern", "01-200000-7");
$ezs->setRecipientData("FH Portal", "Von-Roll-Strasse 10", "4600 Olten", "123456");
$ezs->setPayerData($data['institution'], $data['street'], $data['postalcode'] . " " . $data['city']);
$ezs->setPaymentData($amount, $ref);
$ezs->createEinzahlungsschein(false, true);

$pdf->Output("Kursrechnung_".$ref.".pdf", 'F');

$_SESSION['refn']=$ref;
$_SESSION['partner']=$data['partner'];
$_SESSION['institution']=$data['institution'];
$_SESSION['email']=$data['email'];
$_SESSION['amount']=$amount;

include("sendBill.php");