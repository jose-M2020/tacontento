<?php

require('lib/pdf/fpdf.php');
$id = $p['id'];
$nombre = $p['nombre'];
$apellidos = $p['apellidos'];
$email = $p['email'];
$id_cliente = $p['id_cliente'];
$personas = $p['personas'];
$fecha = $p['fecha'];
$hora = $p['hora'];

class PDF extends FPDF
{ }


$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
//Imagen izquierda
$pdf->Image('images/icon-taco.jpg', 25, 25, 25, 25, 'JPG');

//Imagen derecha
$pdf->Image('images/icon-taco.jpg', 155, 27, 25, 25, 'JPG');

//Texto de Título
$pdf->SetFont('Arial', 'B', 25);
$pdf->SetXY(60, 25);
$pdf->MultiCell(65, 5, utf8_decode('TACONTENTO'), 0, 'C');

//Texto Explicativo
$pdf->SetFont('Courier', '', 13);
$pdf->SetXY(55, 45);
$pdf->MultiCell(100, 4, utf8_decode('LOS MEJORES TACOS DE LA CIUDAD.'), 0, 'J');

//De aqui en adelante se colocan distintos métodos
//para diseñar el formato.

//Fecha
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(145, 60);
$pdf->Cell(15, 8, "$fecha", 0, 'L');


//Nombre //Apellidos //DNI //TELEFONO
$pdf->SetXY(25, 80);
$pdf->Cell(20, 8, 'NOMBRE(S):', 0, 'L');
$pdf->SetXY(52, 80.5);
$pdf->Cell(20, 8, $nombre, 0, 'L');

//*****
$pdf->SetXY(25, 100);
$pdf->Cell(19, 8, 'APELLIDOS:', 0, 'L');
$pdf->SetXY(52, 100);
$pdf->Cell(19, 8, $apellidos, 0, 'L');
//*****
$pdf->SetXY(25, 120);
$pdf->Cell(10, 8, 'ID RESERVA:', 0, 'L');
$pdf->SetXY(55, 120);
$pdf->Cell(10, 8, $id, 0, 'L');
//*****
$pdf->SetXY(110, 120);
$pdf->Cell(10, 8, utf8_decode('Email:'), 0, 'L');
$pdf->SetXY(135, 120);
$pdf->Cell(20, 8, utf8_decode($email), 0, 'L');

//LICENCIATURA  //CARGO   //CÓDIGO POSTAL
$pdf->SetXY(25, 140);
$pdf->Cell(10, 8, utf8_decode('DESCRIPCIÓN:'), 0, 'L');

$pdf->SetXY(25, 160);
$pdf->Cell(20, 8, utf8_decode('PERSONAS:'), 0, 'L');
$pdf->SetXY(85, 160);
$pdf->Cell(20, 8, utf8_decode('FECHA:'), 0, 'L');
$pdf->SetXY(145, 160);
$pdf->Cell(20, 8, utf8_decode('HORA:'), 0, 'L');

$pdf->SetXY(25, 180);
$pdf->Cell(20, 8, utf8_decode($personas), 0, 'L');

$pdf->SetXY(85, 180);
$pdf->Cell(20, 8, utf8_decode($fecha), 0, 'L');

$pdf->SetXY(145, 180);
$pdf->Cell(20, 8, utf8_decode($hora), 0, 'L');



$pdf->Output(); //Salida al navegador;
