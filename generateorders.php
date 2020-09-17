<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include 'database/dbconnect.php';
    $result = $con->query('SELECT  * FROM orders');
    
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
    $header = array('Date', 'Client Name', 'Contact', 'Amount', 'Status', 'Items');
    $w = array(30, 30, 20, 20, 30, 40);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    
        
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','',8);
    // Data
    $fill = false;

    while($row = mysqli_fetch_array($result)) {
        $status = 'Unpaid';
        if($row['status'] == 'delivered'){
            $status = 'Dispatched/Unpaid';
        }elseif($row['status'] == 'confirmed'){
            $status = 'delivered/Paid';
        }
        $pdf->Cell($w[0],6,$row['dateordered'],'LR',0,'L',$fill);
        $pdf->Cell($w[2],6,$row['name'],'LR',0,'L',$fill);
        $pdf->Cell($w[3],6,$row['contact'],'LR',0,'L',$fill);
        $pdf->Cell($w[4],6,$row['amount'],'LR',0,'L',$fill);
        $pdf->Cell($w[5],6,$status,'LR',0,'L',$fill);
        $pdf->Cell($w[1],6,$row['item'],'LR',0,'L',$fill);
        $pdf->Ln();
        $fill = !$fill;
    } 
    // Closing line
    $pdf->Cell(array_sum($w),0,'','T');

    $result->close();  


    

    $pdf->Output();
    //header("location:performance.php");
?>
