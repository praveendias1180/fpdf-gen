<?php namespace MyNamespace;

require_once '../vendor/autoload.php';

$pdf = new \FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','I',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output('F','output.pdf'); 