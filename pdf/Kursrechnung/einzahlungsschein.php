<?php
session_start();
require_once('pdf/Kursrechnung/class.einzahlungsschein.php');
require_once('fpdf/fpdf.php');

require 'database.php';
$id = null;
if (!empty($_GET['id'])) {
$id = $_REQUEST['id'];
}

if (null == $id) {
header("Location: myCourse.php");
} else {
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
$pdo->exec('set names utf8');
$sql = "SELECT * FROM fh where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();
}

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
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 4,
 "Just some dummy text.");

//now simply include your Einzahlungsschein, sending your pdf instance to the Einzahlungsschein class
$ezs = new Einzahlungsschein(196, 0, $pdf);
$ezs->setBankData("Berner Kantonalbank AG", "3001 Bern", "01-200000-7");
$ezs->setRecipientData("FH Portal", "Von-Roll-Strasse 10", "4600 Olten", "123456");
$ezs->setPayerData($data['institution'], $data['street'], $data['postalcode'] . " " . $data['city']);
$ezs->setPaymentData($amount, $ref);
$ezs->createEinzahlungsschein(false, true);

$pdf->Output("pdf/Kursrechnung/Kursrechnung_".$ref.".pdf", 'I');

$_SESSION['refn']=$ref;
$_SESSION['partner']=$data['partner'];
$_SESSION['institution']=$data['institution'];
$_SESSION['email']=$data['email'];
$_SESSION['amount']=$amount;

include("sendBill.php");