<?php
	class PDF extends FPDF{
		function Header(){
	        $this->Image("./Imageneshotel/logo.jpg",5,10,60,18);
	        $this->SetFont('Arial','B',13);    
	        $this->Cell(200,20,'Lista De Ventas ',0,1,'C');
	        $this->Ln(5);
	    }

	    function Footer(){
	        $this->SetY(-15);
	        $this->SetFont('Arial','I',8);
	        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	    }

	    function TablaVentas($header,$Ventas){
		    $this->SetFont('Arial','',10);
		    $this->SetFillColor(20,20,0);
		    $this->SetTextColor(100);
		    $this->SetDrawColor(10,0,0);
		    $this->SetLineWidth(.2);
		    $this->SetFont('','B');

		    $this->Cell(18);
			$w = array(10, 60, 32, 25,25);
		    for($i=0;$i<count($header);$i++)
		        $this->Cell($w[$i],7,$header[$i],1,0,'C');
		    $this->Ln();
		    $con=0;
		    $this->SetFont('Arial','',8);

	        foreach($Ventas as $row){
		    	$con++;$this->Cell(18);
		        $this->Cell($w[0],6,$con,'LR',0,'C');
		         if($row['razonsocial']==''){
		        	$this->Cell($w[1],6,$row['nombre'].' '.$row['appaterno'].' '.$row['apmaterno'],'LR',0,'C');
		        }
		        else{
		        	$this->Cell($w[1],6,$row['razonsocial'],'LR',0,'C');
		        }
		        $this->Cell($w[2],6,$row['fechaventa'],'LR',0,'C');
		        $this->Cell($w[3],6,$row['igv'],'LR',0,'C');
		        $this->Cell($w[4],6,$row['importe'],'LR',0,'C');
		        $this->Ln();
		    }
	        // Línea de cierre
	        $this->Cell(18);
	        $this->Cell(array_sum($w),0,'','T');
	    }
	}

	$pdf = new PDF();
	// Títulos de las columnas
	$header = array('#', 'Cliente', 'Fecha Venta', 'S/. IGV','S/. Total');
	// Carga de datos
	$pdf->SetFont('Arial','',14);
	$pdf->AddPage();
	$pdf->TablaVentas($header,$Ventas);
	$pdf->Output();
?>