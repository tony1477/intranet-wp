<?php

namespace App\Libraries;

// require FCPATH . 'vendor/autoload.php';

use App\Models\ItHelpdeskModel;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SpreadsheetPDF extends Spreadsheet {

    private string $lastModifiedBy;
    private string $className;
    private IWriter $writer;
    private string $title;

    public function __construct() {
        parent::__construct();
        $this->title = 'PDF Document';
        $this->setLastModifiedBy();
        $this->getProperties()->setCreator($this->getLastModifiedBy())
            ->setDescription('Document Generator for Spreadsheet and PDF')
            ->setKeywords('office php');
    }

    private function setClassName($pdfFile='Mpdf') :void {
        switch($pdfFile) {
            case 'Dompdf':
            $stringClass = '\Dompdf';
            break;

            case 'Tcpdf':
            $stringClass = '\Tcpdf';
            break;

            default:
            $stringClass = '\Mpdf';
        }
        $this->className = '\PhpOffice\PhpSpreadsheet\Writer\Pdf'.$stringClass;
        // $this->className = Mpdf::class;
    }

    private function getClassName() {
        return $this->className;
    }
    
    public function setLastModifiedBy($name='Martoni F') :void {
        $this->lastModifiedBy = $name;
    }

    public function setTitle(string $title) :void {
        $this->title = $title;
    }

    public function getTitle() :string {
        return $this->title;
    }
    
    public function getLastModifiedBy() :string {
        return $this->lastModifiedBy;
    }

    private function registerWriter() {
        $this->setClassName();
        IOFactory::registerWriter('Pdf', $this->getClassName());
        // $class = \PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf::class;
        // IOFactory::registerWriter('Pdf', $class);
        $this->writer = IOFactory::createWriter($this, 'Pdf');   
    }

    public function exportPdf() {
        header('Content-type:application/pdf');
        $this->registerWriter();
        $this->writer->save('php://output');       
    }

    public function exportXls() {
        $filename='C:\laragon\tmp'."\\".$this->getTitle().".xls";
        $template = 'C:\laragon\www\intranet-wp\templates\ithelpdesk-rincian.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($template);
        $worksheet = $spreadsheet->getActiveSheet();

        $array = [
            'startDate' => '2024-04-01',
            'endDate' => '2024-04-30',
        ];
        $model = new ItHelpdeskModel();
        $result = $model->reportRincianItHelpdesk($array);
        $i=3;
        foreach($result as $row):
            $worksheet->setCellValue("A{$i}",$row['tanggal']);
            $worksheet->setCellValue("B{$i}",$row['ticketno']);
            $worksheet->setCellValue("C{$i}",$row['lokasi']);
            $worksheet->setCellValue("D{$i}",$row['departemen']);
            $worksheet->setCellValue("E{$i}",$row['Jenis']);
            $worksheet->setCellValue("F{$i}",$row['Kategori']);
            $worksheet->setCellValue("G{$i}",$row['divisi']);
            $worksheet->setCellValue("H{$i}",$row['User']);
            $worksheet->setCellValue("I{$i}",$row['PelaksanaIT']);
            $worksheet->setCellValue("J{$i}",$row['Permintaan']);
            $worksheet->setCellValue("K{$i}",$row['Alasan']);
            $worksheet->setCellValue("L{$i}",$row['RespIT']);
            $worksheet->setCellValue("M{$i}",$row['Penyebab/Alasan']);
            $worksheet->setCellValue("N{$i}",$row['RekomendasiIT']);
            $i++;
        endforeach;

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save($filename);
        
        // header('Content-type:application/pdf');
        header('Content-Description: File Transfer');
        header('Content-Type:  application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
        unlink($filename);
    }

    public function exportXls1() {
        $filename='C:\laragon\tmp'."\\".$this->getTitle().".xlsx";
        $this->writer = new Xlsx($this);
        $this->writer->save($filename);
        
        header('Content-Description: File Transfer');
        header('Content-Type:  application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
        unlink($filename);
    }

    public function export($type) {
        $type == 'pdf' ? $this->exportPdf() : $this->exportXls();
        $this->getProperties()->setTitle($this->getTitle());
        exit();
    }

    function addHeadersFooters(string $html): string {
        $pagerepl = <<<EOF
        @page page0 {
        odd-header-name: html_myHeader1;
        even-header-name: html_myHeader1;
        odd-footer-name: html_myFooter2;
        even-footer-name: html_myFooter2;

        EOF;
            $html = preg_replace('/@page page0 {/', $pagerepl, $html);
            $bodystring = '/<body>/';
            $bodyrepl = <<<EOF
        <body>
            <htmlpageheader name="myHeader1" style="display:none">
                <div style="text-align: right; border-bottom: 1px solid #000000; font-weight: bold; font-size: 10pt;">
                    My document header
                </div>
            </htmlpageheader>

            <htmlpagefooter name="myFooter2" style="display:none">
                <table width="100%">
                    <tr>
                        <td width="33%">My document</td>
                        <td width="33%" align="center">Page {PAGENO} of {nbpg}</td>
                        <td width="33%" style="text-align: right;">{DATE Y-m-j}</td>
                    </tr>
                </table>
            </htmlpagefooter>

        EOF;

        return preg_replace($bodystring, $bodyrepl, $html);
    }

    public function save() {
        // save to file
    }
}
