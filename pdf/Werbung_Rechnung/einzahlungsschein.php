<?php
session_start();
require_once('class.einzahlungsschein.php');
require_once('../../fpdf/fpdf.php');

require '../../database.php';
$id = null;
if (!empty($_GET['id'])) {
$id = $_REQUEST['id'];
}

if (null == $id) {
header("Location: ../../addAd.php");
} else {
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
$pdo->exec('set names utf8');
$sql = "SELECT * FROM ads where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();
}

if(strcmp($data['duration'],"1 Woche")== 0){
    $return = floatval(50.00);
}if(strcmp($data['duration'],"2 Wochen")== 0){
    $return = floatval(100.00);
}if(strcmp($data['duration'],"3 Wochen")== 0){
    $return = floatval(140.00);
}if(strcmp($data['duration'],"1 Monat")== 0){
    $return = floatval(180.00);
}
      
$amount = $return;
$ref = "5000000000"+$data["id"];

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
$pdf->Cell(50, 4, $data['firstname']."".$data['lastname'],0, 1);
$pdf->Cell(50, 4, $data['street'],0, 1);
$pdf->Cell(50, 4, $data['plz']." ".$data['city'],0, 1);
$pdf->Cell(50, 10, "",0, 1);
$pdf->Cell(190, 4, "","T", 1);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(100, 4, "FH Portal Rechnungsnummer: ".$ref,0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(91, 4, $date,0,1,'R');
$pdf->Cell(50, 10, "",0, 1);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(100, 4, "Sehr geehrte/r ".$data['gender']." ".$data['lastname'],0,1);
$pdf->Cell(50, 4, "",0, 1);
$pdf->MultiCell(190, 4, "Sie haben auf dem FH Portal Werbefl".chr(228)."che f".chr(252)."r ".$data['duration']." gemietet. Bitte begleichen Sie den Betrag von CHF ".$amount." innerhalb der n".chr(228)."chsten vier Wochen.",0, 1);
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
$ezs->setPayerData($data['firstname'] . " " . $data['lastname'], $data['street'], $data['plz'] . " " . $data['city']);
$ezs->setPaymentData($amount, $ref);
$ezs->createEinzahlungsschein(false, true);

$pdf->Output("Rechnung_".$ref.".pdf", 'F');

$_SESSION['refn']=$ref;
$_SESSION['gender']=$data['gender'];
$_SESSION['lastname']=$data['lastname'];
$_SESSION['email']=$data['email'];
$_SESSION['amount']=$amount;

include("sendBill.php");