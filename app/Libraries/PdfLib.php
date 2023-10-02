<?php

namespace App\Libraries;

use Mpdf\Mpdf;
use Mpdf\HTMLParserMode;

class PdfLib {
    protected $mpdf;

    public function __construct()
    {
        $this->mpdf = new Mpdf();
    }

    public function setCss($file)
    {
        $this->mpdf->WriteHTML($file,\Mpdf\HTMLParserMode::HEADER_CSS);
    }

    public function generate($html,$filename='document.pdf',$paper_size='A4',$orientation='portrait')
    {
        // $this->mpdf->charset_in = 'UTF-8';
        
        // Set paper size and orientation
        $this->mpdf->AddPage($orientation, '', '', '', '', 15, 15, 15, 15, 10, 10);
 
        $this->mpdf->WriteHTML($html);

        // Output the generated PDF to the browser or save it to a file
        if (defined('STDIN')) {
            // Save the PDF to a file when running via CLI (Command Line Interface)
            $this->mpdf->Output($filename, \Mpdf\Output\Destination::FILE);
        } else {
            // Output the PDF to the browser when running via web server
            $this->mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
        }

    }
}