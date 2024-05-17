<?php

namespace App\Libraries;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;
use Mpdf\Mpdf as BaseMpdf;

class Pdf extends Mpdf
{
    private $headerText;
    private $footerText;
    private $mpdf;

    public function __construct(Spreadsheet $spreadsheet, $config = [])
    {
        parent::__construct($spreadsheet);
        $this->mpdf = new BaseMpdf($config);
    }

    public function setHeaderText($text)
    {
        $this->headerText = $text;
    }

    public function setFooterText($text)
    {
        $this->footerText = $text;
    }

    public function setCustomHeaderFooter()
    {
        // Add custom header
        $this->mpdf->SetHTMLHeader($this->headerText);

        // Add custom footer
        $this->mpdf->SetHTMLFooter($this->footerText);
    }

    public function saved($filename)
    {
        $this->setCustomHeaderFooter();
        parent::save($filename);
    }
}
