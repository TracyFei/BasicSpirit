<?php
// Require composer autoloaduse PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;

require_once __DIR__ . '/vendor/autoload.php';
// $mpdf->allow_charset_conversion=true;

// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
// $mpdf->allow_charset_conversion = true;
// $mpdf->charset_in = 'iso-8859-4';
$a = file_get_contents("http://localhost/BasicSpirit/invoice.php");
// Write some HTML code:
$mpdf->WriteHTML(mb_convert_encoding($a, 'UTF-8', 'UTF-8'));

// Output a PDF file directly to the browser
$mpdf->Output();

?>