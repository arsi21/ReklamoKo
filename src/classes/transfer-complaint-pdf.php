<?php
require("./pdf-generator/fpdf.php");

class PDF extends FPDF{
    protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';

    // Page header
    function Header()
    {
        // Logo
        //$this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',12);
        // Title
        $this->Cell(190,10,'Republika ng Pilipinas',0,0,'C');
        // Line break
        $this->Ln();
        $this->SetFont('Arial','B',12);
        $this->Cell(190,5,'Lalawigan ng Nueva Ecija',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',12);
        $this->Cell(190,10,'Bayan ng Rizal',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',12);
        $this->Cell(190,5,'Barangay Agbannawag',0,0,'C');
        $this->Ln(20);
        $this->SetFont('Arial','B',18);
        $this->Cell(190,5,'TANGGAPAN NG LUPONG TAGAPAMAYAPA',0,0,'C');
        $this->Ln();
    }

    // Simple table
    function SubHeading($complainant, $complainee, $type, $SUB_HEADING)
    {
        $this->SetFont('Arial','B',12);
        $this->Cell(190,15,$SUB_HEADING,0,0,'C');
        $this->Ln(30);
        $this->SetFont('Arial','',12);
        $this->Cell(190,5,$complainant,0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',12);
        $this->Cell(190,5,'(Nagsusumbong)',0,0,'C');
        $this->Ln(10);
        $this->SetFont('Arial','B',12);
        $this->Cell(95,7,'LABAN KAY/KINA:',0,0,'C');
        $this->Cell(95,7,'PARA SA:',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','',12);
        $this->Cell(95,7,$complainee,0,0,'C');
        $this->Cell(95,7,$type,0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',12);
        $this->Cell(95,7,'(Ipinagsusumbong)',0,0,'C');
        $this->Ln(20);
        $this->SetFont('Arial','B',15);
        $this->Cell(190,5,'PAGPAPATUNAY PARA MAGHAIN NG PORMAL NA SAKDAL',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',12);
        $this->Cell(190,10,'(Certificate to File Action)',0,0,'C');
        $this->Ln(15);
        $this->SetFont('Arial','',12);
    }

    function Footer()
    {
        $this->Ln(10);
        $this->SetFont('Arial','B',12);
        $this->Cell(190,10,'NAGPAPATUNAY:',0,0,'C');
        $this->Ln(20);
        $this->SetFont('Arial','',12);
        $this->Cell(95,7,'ESTANISLAO DELA CRUZ',0,0,'C');
        $this->Cell(95,7,'PEDRO DELA CRUZ',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',12);
        $this->Cell(95,7,'PANGKAT CHAIRMAN',0,0,'C');
        $this->Cell(95,7,'PANGKAT SECRETARY',0,0,'C');
        $this->Ln(20);
    }

    function WriteHTML($html){
        // HTML parser
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                // Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,$e);
            }
            else
            {
                // Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    // Extract attributes
                    $a2 = explode(' ',$e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        // Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='BR')
            $this->Ln(5);
    }

    function CloseTag($tag)
    {
        // Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable)
    {
        // Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s)
        {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt)
    {
        // Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }


}
