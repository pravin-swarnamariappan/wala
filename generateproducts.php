<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include 'database/dbconnect.php';
    $result = $con->query('SELECT  p.id, p.product, p.description, p.price, c.title FROM products AS p JOIN category AS c where p.category_id = c.id');

    require('fpdf/fpdf.php');

        class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            // Logo
            //$this->Image('logo.png',10,6,30);
            // Arial bold 15
            $this->SetFont('Arial','B',16);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,'Online Store',0,0,'C');
            $this->SetFont('Arial','i',12);
            $this->Ln(7);
            $this->Cell(0,10,'Products Report',0,0,'C');

        }

        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Ln(15);

     // Colors, line width and bold font
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B');
    // Header
    $header = array('Product Name', 'Category', 'Price');
    //$w = array(40, 35, 40, 45);
    for($i=0;$i<count($header);$i++)
    if($i == 0){
        $pdf->Cell(60,7,$header[$i],1,0,'C',true);
    }else{
        $pdf->Cell(40,7,$header[$i],1,0,'C',true);
    }

    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');
    // Data
    $fill = false;

    while($row = mysqli_fetch_array($result)) {
        $pdf->Cell(60,6,$row['product'],'LR',0,'L',$fill);
        $pdf->Cell(40,6,$row['title'],'LR',0,'L',$fill);
        $pdf->Cell(40,6,$row['price'],'LR',0,'L',$fill);
        $pdf->Ln();
        $fill = !$fill;
    }
    // Closing line
    $pdf->Cell(140,0,'','T');

    $result->close();




    $pdf->Output();
    //header("location:performance.php");
?>
