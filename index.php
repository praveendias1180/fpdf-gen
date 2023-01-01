<?php
require_once 'vendor/autoload.php';

use PSR4\Autoload\Testing\Printing\PrintPDF;

$printer = new PrintPDF();
$printer->print();