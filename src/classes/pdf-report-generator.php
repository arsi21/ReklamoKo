<?php
require ("../dompdf/autoload.php");
    use Dompdf\Dompdf;
    use Dompdf\Options;
class PdfReportGenerator{

    // public function generatePdf($reportTitle, $headers, $datas){
    //     $html = "<h1>$reportTitle</h1>";
    //     $html .= "<table><tr>";
    //     foreach($headers as $header){
    //         $html .= "<th>$header</th>";
    //     }
    //     $html .= "</tr>";
    //     $html .= "</table>";

    //     /**
    //      * Set the Dompdf options
    //      */
    //     $options = new Options;
    //     $options->setChroot(__DIR__);

    //     $dompdf = new Dompdf($options);

    //     $dompdf->loadHtml($html);

    //     /**
    //      * Create the PDF and set attributes
    //      */
    //     $dompdf->render();

    //     $dompdf->addInfo("Title", "Report"); // "add_info" in earlier versions of Dompdf

    //     /**
    //      * Send the PDF to the browser
    //      */
    //     $dompdf->stream("report.pdf", ["Attachment" => 0]);
    // }





    // public function generateComplaintReportPdf() {
    //     $date = "12-21-2022";
    //     $complainants = "John Doe";
    //     $complainees = "Juan Cruz";
    //     $complaintType = "Complaint Type";
    //     $description = "Aasdfasdf";
    //     $userName = "John Smith";

    //     $options = new Options;
    //     $options->setChroot(__DIR__);
    //     $dompdf = new Dompdf($options);

    //     $dompdf->setPaper("A4", "portrait");

    //     $html = file_get_contents("../pdf-template/complaint-template.html");

    //     $html = str_replace(["{{ complaintDate }}", "{{ complainants }}", "{{ complainees }}", "{{ complaintType }}", "{{ description }}", "{{ userName }}"], [$date, $complainants, $complainees, $complaintType, $description, $userName], $html);

    //     $dompdf->loadHtml($html);
    //     $dompdf->render();

    //     $dompdf->addInfo("Title", "An Example PDF");

    //     $dompdf->stream("invoice.pdf", ["Attachment" => 0]);
    // }







    // public function generateComplaintReportPdf() {
    //     $options = new Options;
    //     $options->setChroot(__DIR__);
    //     $dompdf = new Dompdf($options);

    //     $dompdf->setPaper("A4", "portrait");
       
    //     ob_start();
    //     require("../pdf-template/complaint-details-pdf.php");
    //     $html = ob_get_contents();
    //     ob_get_clean();

    //     $dompdf->loadHtml($html);
    //     $dompdf->render();
        

    //     $dompdf->addInfo("Title", "Report");

    //     $dompdf->stream("report.pdf", ["Attachment" => 0]);
    // }




    public function generateComplaintReportPdf($id, $title) {
        $options = new Options;
        $options->setChroot(__DIR__);
        $dompdf = new Dompdf($options);

        $dompdf->setPaper("A4", "portrait");


        if(!isset($_SESSION)){
            session_start();
        }
        //include needed files
        include "dbh.php";
        include "dashboard.php";
        
        //instantiate class
        $model = new Dashboard();
        
        $datas = $model->getComplaintsForComplainee($id);
        
        $userName = $_SESSION['firstName']. " " .$_SESSION['lastName'];


       
        ob_start();
        require("../pdf-template/complaint-details-pdf.php");
        $html = ob_get_contents();
        ob_get_clean();

        $dompdf->loadHtml($html);
        $dompdf->render();
        

        $dompdf->addInfo("Title", "Report");

        $dompdf->stream("report.pdf", ["Attachment" => 0]);
    }
}


// $pdf = new PdfReportGenerator();
// $pdf->generateComplaintReportPdf();
// $pdf = new PdfReportGenerator();
// $pdf->generateComplaintReportForComplaineePdf();