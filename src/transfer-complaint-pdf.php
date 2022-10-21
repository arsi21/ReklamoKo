<?php
//include needed files
include "classes/transfer-complaint-pdf.php";

$complainant = $_GET['complainant'];
$complainee = $_GET['complainee'];
$type = $_GET['type'];
$date = date("m-d-Y", strtotime($_GET['date']));

$SUB_HEADING = "Usaping Barangay Blg.:" . $date;

$paragraph = 
'
<p><b>ITO AY PAGPAPATUNAY:</b></p><br><br>
<p><b>1. </b>Na nagkaroon ng personal na paghaharap ang magkabilang panig na pinamagitan ng <b>PUNONG BARANGAY</b>, subalit nabigo ang PUNONG BARANGAY na mapagkasundo ang magkabilang panig sa mapayapang pamamaraan.</p><br><br>
<p><b>2. </b>Na ang PUNONG BARANGAY ay nagtakda ng pagpupulong ng magkabilang panig para sa pagbuo ng <b>PANGKAT TAGAPAGSUNDO</b>.</p><br><br>
<p><b>3. </b>Na ang mga ipinagsusumbong ay hindi dumalo o tahasan na hindi humarap sa PANGKAT dahil sa mga kadahilanan na hindi maaring bigyang katuwiran.</p><br><br>
<p><b>4. </b>Kung kaya ang nasabing sumbong para sa nabanggit na USAPING BARANGAY ay maari ng ihain sa <b>HUKUMAN O TANGGAPAN NG PAMAHALAAN</b>.</p><br><br>
<p><b>NGAYONG '. $date . '</b>.</p><br>
';


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('','A4',0);
$pdf->SetFont("Arial","",12);
$pdf->SubHeading($complainant, $complainee, $type, $SUB_HEADING);
$pdf->WriteHTML($paragraph);
$pdf->Output();