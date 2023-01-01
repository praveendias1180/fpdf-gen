<?php namespace PSR4\Autoload\Testing\Printing;

use CMS\Helpers\Print\Test\PDF;
use DOMDocument;
use DOMXPath;

class PrintPDF{
    function print(){
        $fontName = 'Arial';
        $fontSize = '16';
        
        $content = '
        <div class="container">
            Outside content. <p><b>This</b> is <i>content</i> inside p tag. This is <em>inside em tag</em>.</p>
        </div>';
        $fp = strip_tags($content,'<p><i><em>');
        
        $dom = new DOMDocument();
        $dom->loadHTML($fp);
        $xp = new DOMXPath($dom);
        $fp = iconv('UTF-8', 'windows-1252', $fp);
        $elements = $dom->getElementsByTagName('*');
        
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont($fontName,'I',$fontSize);
        
        foreach($elements as $element) {
            if($element->nodeName === 'p') {
        
                foreach($element->childNodes as $childNode){
                    if($childNode->nodeName === 'i' || $childNode->nodeName === 'em'){
                        $pdf->SetFont($fontName,'I',$fontSize);
                    } else if($childNode->nodeName === 'b'){
                        $pdf->SetFont($fontName,'B',$fontSize);
                    } else {
                        $pdf->SetFont($fontName,'',$fontSize);
                    }
                    $pdf->Write(40,$childNode->nodeValue);
                }
            }
        }
        
        $pdf->Output('F','output.pdf'); 
    }
}