<?php namespace CMS\Helpers\Print\Test;

use FPDF;

class PDF extends FPDF{
    function header(){
        echo 'in header now';
    }
}