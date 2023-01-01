<?php namespace PSR4\Autoload\Testing\Printing;

use CMS\Helpers\Print\Test\PDF2 as PDF;
use DOMDocument;
use DOMXPath;

class PrintPDF2{
    function print(){
        $fontName = 'Arial';
        $fontSize = '16';
        
        $content = '
        <div class="container">
            Outside content. <p><b>This</b> is <i>new content</i> inside p tag. This is <em>inside em tag</em>.</p>
        </div>';

        $content = str_replace(
            ['<i>', '</i>', '<em>', '</em>','<b>', '</b>'], 
            ['ITAGSTART', 'ITAGEND', 'EMTAGSTART', 'EMTAGEND', 'BTAGSTART', 'BTAGEND'],
            $content
        );

        /**
         * Strip all tags
         */
        $fp = strip_tags($content);
        
        $dom = new DOMDocument();
        $dom->loadHTML($fp);
        $xp = new DOMXPath($dom);
        $fp = iconv('UTF-8', 'windows-1252', $fp);
        $elements = $dom->getElementsByTagName('*');
        
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont($fontName,'',$fontSize);
        
        foreach($elements as $element) {
            if($element->nodeName === 'p') {
                $pdf->Writer(40,$element->nodeValue);
            }
        }
        
        $pdf->Output('F','output.pdf'); 
    }
}