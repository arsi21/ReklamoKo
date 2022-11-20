<?php
require ("../dompdf/autoload.php");
    use Dompdf\Dompdf;
    use Dompdf\Options;
class PdfReportGenerator{

    public function generatePdf($reportTitle, $headers, $datas){
        $html = "<h1>$reportTitle</h1>";
        $html .= "<table><tr>";
        foreach($headers as $header){
            $html .= "<th>$header</th>";
        }
        $html .= "</tr>";
        $html .= "</table>";

        /**
         * Set the Dompdf options
         */
        $options = new Options;
        $options->setChroot(__DIR__);

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);

        /**
         * Create the PDF and set attributes
         */
        $dompdf->render();

        $dompdf->addInfo("Title", "Report"); // "add_info" in earlier versions of Dompdf

        /**
         * Send the PDF to the browser
         */
        $dompdf->stream("report.pdf", ["Attachment" => 0]);
    }
}
