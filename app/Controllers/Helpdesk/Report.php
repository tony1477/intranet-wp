<?php

namespace App\Controllers\Helpdesk;

use App\Controllers\BaseController;
use App\Libraries\DataTrait;
use App\Models\DivisiModel;
use App\Models\HelpdeskChoiceModel;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Libraries\SpreadsheetPDF;
use App\Models\ItHelpdeskModel;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Number;


class Report extends BaseController
{
    private array $listReport;
    use DataTrait;
    private SpreadsheetPDF $spreadsheet;
    private ItHelpdeskModel $model;

    public function __construct()
    {
        $this->listReport = [
            'Rincian Report IT Helpdesk',
            'Rekap Report IT Helpdesk'
        ];
        $this->model = new ItHelpdeskModel();
    }

    public function index() :string
    {
        helper(['admin_helper']);
        $menu = getMenu($user='Admin');
        $lokasi = new DivisiModel();
        $category = new HelpdeskChoiceModel();
        $authorize = service('authorization');
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Report_Helpdesk']),
			'page_title' => view('partials/page-title', ['title' => 'Report_Helpdesk', 'li_1' => 'Intranet', 'li_2' => 'Report_Helpdesk']),
			'modules' => $menu,
            'report' => [
                'reportType' => $this->listReport,
                'location' => $lokasi->select('iddivisi,div_nama')->asArray()->findAll(),
                'category' => $category->select('choiceid,choicename')->asArray()->whereIn('parentid',[2,3])->findAll(),
                'responder' => [...$authorize->usersInGroup('wfitsystem'),...$authorize->usersInGroup('wfitinfra')],
            ],
		];
        return view('helpdesk/reports/index',$data);
    }

    public function generate() {
        $this->spreadsheet = new SpreadsheetPDF();
        $this->storeForm($_GET);
        $export = 'pdf';
        $reportType = $this->getValue('reportType');
        $this->spreadsheet->setTitle($this->getReportType($this->getValue('reportType')));
        $this->makeReport($reportType);   
        if($this->getValue('type')==='xls') $export='xls';
        $this->spreadsheet->export($export);
       
    }

    protected function rincianItHelpdesk() :void {
        $dateFormat = new Date();
  
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setShowGridLines(true);
        $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

        $sheet->getHeaderFooter()
            ->setOddFooter('&L&B' . $this->spreadsheet->getProperties()->getTitle() . '&RPage &P of &N');
        
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            // 'fill' => [
            //     'fillType' => Fill::FILL_SOLID,
            //     'color' => ['argb' => 'FFFFFFFF'],
            // ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_TOP,
                'wrapText' => true,
            ],
        ];
        // $sheet->getStyle([1,1,14,1])->applyFromArray($styleArray);
        // $sheet->getStyle([1,2,14,2])->applyFromArray($styleArray);

        $sheet->mergeCells('A1:N1')->setCellValue('A1', sprintf('Rincian Report IT Helpdesk Per Tanggal : %s hingga tanggal : %s ', date('d/m/Y',strtotime($this->getValue('startDate'))), date('d/m/Y',strtotime($this->getValue('endDate')))));
        $sheet->setCellValue('A2', 'Tanggal');
        $sheet->setCellValue('B2', 'No Ticket');
        $sheet->setCellValue('C2', 'Lokasi');
        $sheet->setCellValue('D2', 'Departemen');
        $sheet->setCellValue('E2', 'Jenis');
        $sheet->setCellValue('F2', 'Kategori');
        $sheet->setCellValue('G2', 'Divisi');
        $sheet->setCellValue('H2', 'User');
        $sheet->setCellValue('I2', 'Pelaksana IT');
        $sheet->setCellValue('J2', 'Permintaan');
        $sheet->setCellValue('K2', 'Alasan');
        $sheet->setCellValue('L2', 'Respon IT');
        $sheet->setCellValue('M2', 'Penyebab/Alasan');
        $sheet->setCellValue('N2', 'Rekomendasi IT');        

        $result = $this->model->reportRincianItHelpdesk($this->array);
        $i=3;
        foreach($result as $row):
            $sheet->getStyle([1,$i,14,$i])->applyFromArray($styleArray);
            $sheet->setCellValue("A{$i}",$row['tanggal']);
            $sheet->setCellValue("B{$i}",$row['ticketno']);
            $sheet->setCellValue("C{$i}",$row['lokasi']);
            $sheet->setCellValue("D{$i}",$row['departemen']);
            $sheet->setCellValue("E{$i}",$row['Jenis']);
            $sheet->setCellValue("F{$i}",$row['Kategori']);
            $sheet->setCellValue("G{$i}",$row['divisi']);
            $sheet->setCellValue("H{$i}",$row['User']);
            $sheet->setCellValue("I{$i}",$row['PelaksanaIT']);
            $sheet->setCellValue("J{$i}",$row['Permintaan']);
            $sheet->setCellValue("K{$i}",$row['Alasan']);
            $sheet->setCellValue("L{$i}",$row['RespIT']);
            $sheet->setCellValue("M{$i}",$row['Penyebab/Alasan']);
            $sheet->setCellValue("N{$i}",$row['RekomendasiIT']);
            $i++;
        endforeach;
    }

    protected function rekapItHelpdesk() :void {

    }

    private function getReportType(int $index) :string {
        return $this->listReport[$index];
    }

    private function storeForm(array $data) {
        $this->storeData($data);
    }

    private function makeReport($reportType) :void {
        switch($reportType) {
            case '0' :
            $this->rincianItHelpdesk();
            break;

            case '1' :
                $this->rekapItHelpdesk();
            break;
        }
    }

}
