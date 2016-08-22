<?php
	class PDF extends FPDF{
		function Header(){
	        $this->Image("./Imageneshotel/logo.jpg",5,10,60,18);
	        $this->SetFont('Arial','B',13);    
	        $this->Cell(200,20,'Lista De Movimientos Tarapoto Inn',0,1,'C');
	        $this->Ln(5);
	    }

	    function Footer(){
	        $this->SetY(-15);
	        $this->SetFont('Arial','I',8);
	        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	    }

	    function TablaCompras($header,$Movimientoslista){
		    $this->SetFont('Arial','',10);
		    $this->SetFillColor(20,20,0);
		    $this->SetTextColor(100);
		    $this->SetDrawColor(10,0,0);
		    $this->SetLineWidth(.2);
		    $this->SetFont('','B');

		    $this->Cell(18);
			$w = array(10, 45, 32, 25,25,20);
		    for($i=0;$i<count($header);$i++)
		        $this->Cell($w[$i],7,$header[$i],1,0,'C');
		    $this->Ln();
		    $con=0;$ingresos=0;$egresos=0;
		    $this->SetFont('Arial','',8);

	        foreach($Movimientoslista as $row){
		    	$con++;$this->Cell(18);
		        $this->Cell($w[0],6,$con,'LR',0,'C');
		        if ($row['rz']=="") {
		        	$this->Cell($w[1],6,$row['nomc'].' '.$row['app'],'LR',0,'C');
		        }else{
		        	$this->Cell($w[1],6,$row['rz'],'LR',0,'C');
		        }		        
		        $this->Cell($w[2],6,$row['concepto'],'LR',0,'C');
		        $this->Cell($w[3],6,$row['comprobante'],'LR',0,'C');
		        $this->Cell($w[4],6,$row['nrocomprobante'],'LR',0,'C');
		        $this->Cell($w[5],6,$row['monto'],'LR',0,'C');

		        //Totales Ingresos Egresos
		        if ($row['tipom']==1) {
		        	$ingresos=$ingresos+$row['monto'];
		        }else{
		        	$egresos=$egresos+$row['monto'];
		        }
		        $this->Ln();
		    }
	        // Línea de cierre
	        $this->Cell(18);
	        $this->Cell(array_sum($w),0,'','T');

	        //Informe Final Montos Totales
	        $this->Ln(10);
	        $this->SetFont('Arial','',12);
	        $this->Cell(130,4,'TOTAL INGRESOS : '.$ingresos.' SOLES',0,1,'C');
	        $this->Cell(210,-4,' +++ ',0,1,'C');
	        $this->Cell(285,4,'TOTAL EGRESOS : '.$egresos.' SOLES',0,1,'C');
	    }
	}

	$pdf = new PDF();
	// Títulos de las columnas
	$header = array('#', 'Cliente', 'Concepto', 'Comprobante', 'Nro Comprob.','S/. Monto');
	// Carga de datos
	$pdf->SetFont('Arial','',14);
	$pdf->AddPage();
	$pdf->TablaCompras($header,$Movimientoslista);
	$pdf->Output();
?>