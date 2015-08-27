<?php
	require("fpdf/fpdf.php");

	class PDF extends FPDF
	{
		function header()
		{
			$this->Image('logo.png',10,6,30);
			$this->SetFont("Arial","B","20");
			$this->Cell(80);//Move to the right
			$this->Cell(30,10,'Invoice',1,0,'C');
			$this->Ln(20);//line break
		}

		function footer()
		{
			$this->SetY(-15);//position at 1.5 cm from bottom
			$this->SetFont('','','15');
			$this->Cell(0,10,''.$this->PageNo().'/{nb}',0,0,'C');
		}
	}

	$pdf =  new PDF();
	//var_dump(get_class_methods($pdf));
	$pdf->AliasNbPages();
	$pdf->AddPage();//parameter could be path where you want to save pdf
	$pdf->SetFont("Times","","12");//"fontfamily","fontstyle","fontsize"
	for($i=1;$i<=40;$i++)
		$pdf->Cell(0,10,"My PDF PAGE".$i,0,1,"C");//width,height ,,content,border,1->newline 0->append in same line ,alignment
	$pdf->SetFont("Arial","","10");//"fontfamily","fontstyle","fontsize"
	$pdf->Cell(0,10,"Second line",0,1,"C");//width,height ,,content,border,1->newline 0->append in same line ,alignment

	$pdf->SetFont("Arial","","10");//"fontfamily","fontstyle","fontsize"
	$pdf->write(5,"data");//height_of_data, content
	$pdf->Output();


?>

<?//php
// if(!empty($_POST['submit']))
// {
// 	$f_name = $_POST['first_name'];
// 	$l_name = $_POST['last_name'];

// 	require("fpdf/fpdf.php");
// 	$pdf = new FPDF();
// 	$pdf->AddPage();
// 	//var_dump(get_class_methods($pdf));
// 	$pdf->SetFont('Arial','B','15');
// 	$pdf->Cell(0,10,"welcome {$f_name}",0,1,'C');
// 	//table
// 	$pdf->Cell(50,10,"Last name :",1,0);
// 	$pdf->Cell(50,10,$l_name,1,1);

// 	$pdf->Cell(50,10,"First name :",1,0);
// 	$pdf->Cell(50,10,$f_name,1,1);
// 	$pdf->Output();
// }

//?>