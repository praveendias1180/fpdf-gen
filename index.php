<?php
require_once 'vendor/autoload.php';

use PSR4\Autoload\Testing\Printing\PrintPDF2 as Printer;

$printer = new Printer();
$printer->print();