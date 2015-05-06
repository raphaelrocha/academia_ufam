

<?php
	$oon = mysqli_connect("localhost", "root", "mysql", "academia_db");

	$listagem = mysqli_query($oon, "SELECT ID_CURSO, NOME_CURSO FROM CURSO ORDER BY NOME_CURSO;");

	require('fpdf/fpdf.php');

	function converte($string)
    {
        return iconv("UTF-8", "ISO-8859-1", $string);
    }

	class PDF extends FPDF
	{
		// Page header
		function Header()
		{
		    // Logo Brasao
		    $this->Image('brasao.png',10,10,80);		    

		    // Title
		    $this->Cell(80);
		    $this->SetFont('Arial','B',12);
		    $this->Cell(380,15,'PODER EXECUTIVO', 0, 1,'C');

		    $this->SetFont('Arial','',10);
		    $this->Cell(80);
		    $this->Cell(380,15,converte('MINISTÉRIO DA EDUCAÇÃO'), 0, 1,'C');

		    $this->SetFont('Arial','',10);
		    $this->Cell(80);
		    $this->Cell(380,15,'UNIVERSIDADE FEDERAL DO AMAZONAS', 0, 1,'C');

		    $this->SetFont('Arial','',10);
		    $this->Cell(80);
		    $this->Cell(380,20,converte('PRÓ-REITORIA DE ASSUNTOS COMUNITÁRIOS'), 0, 1,'C');
	
		    // Logo Ufam
		    $this->Image('logo.png', 500, 11, 80);
		    // Line break
		    $this->Ln(10);
		    $this->SetLineWidth(0.5); 
			$this->Line(580, 100, 10, 100);
		}
	}


	$pdf = new PDF("P", "pt", "A4");

	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->Ln(20);

    $pdf->SetFont("arial", "B", "18");
    $pdf->Cell(0, 5, converte("Cursos"), 0, 1, "C");
    $pdf->Ln(20);

    $pdf->SetFont("arial", "B", 14);
    $pdf->Cell(80, 20, 'ID Curso', 1, 0, "C");
    $pdf->Cell(460, 20, 'Nome', 1, 1, "C");

    $pdf->SetFont("arial", "", 12);

    while($linha = mysqli_fetch_array($listagem))
    {
        $pdf->Cell(80, 20, $linha["ID_CURSO"], 1, 0,"C");
        $pdf->Cell(460, 20, $linha["NOME_CURSO"], 1, 1,"C");
    }

	$pdf->Output();
?>
