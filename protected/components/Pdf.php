<?php

//require('fpdf/fpdf.php');
Yii::import('ext.fpdf.fpdf', true);



class Pdf extends FPDF
{
	// Page header
	function Header()
	{
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$date = new DateTime();
		$hora = $date->format("H:i:s");
		$data = $date->format("d/m/Y");

		$trata = new TrataString();
		// Logo Brasao
		$this->Image('images/brasao.png',10,10,80);

		// Title
		$this->Cell(80);
		$this->SetFont('Arial','B',12);
		$this->Cell(380,15,'PODER EXECUTIVO', 0, 1,'C');

		$this->SetFont('Arial','',10);
		$this->Cell(80);
		$this->Cell(380,15,$trata->converte('MINISTÉRIO DA EDUCAÇÃO'), 0, 1,'C');

		$this->SetFont('Arial','',10);
		$this->Cell(80);
		$this->Cell(380,15,'UNIVERSIDADE FEDERAL DO AMAZONAS', 0, 1,'C');

		$this->SetFont('Arial','',10);
		$this->Cell(80);
		$this->Cell(380,20,$trata->converte('PRÓ-REITORIA DE ASSUNTOS COMUNITÁRIOS'), 0, 1,'C');

		// Logo Ufam
		$this->Image('images/logo.png', 500, 11, 80);

		// Line break
		$this->Ln(10);
		$this->SetLineWidth(0.5);
		$this->Line(580, 100, 10, 100);

		$this->SetFont("arial", "", "8");
		$this->Cell(0, 5, $trata->converte("Documento gerado em ".$data." às ".$hora), 0, 1, "R");
		$this->Ln(20);
	}



}
