<?php


namespace Modules\Reports\Reports;


use Carbon\Carbon;
use Modules\Reports\Entities\ReportMaster;
use PDF;

class AbstractReport
{

    public $startDate;
    public $endDate;
    public $options;
    public $createdBy;
    
    public $defaultViewName = 'reports::reports.report';
    public $pageSize;
    public $pageOrientation;


    public $totals = [];
    public $columns = [];
    public $data;

    public $name;

    public $pdf;
    public $csv;

    public $setupDone;

    public $reportMaster;

    public function __construct(ReportMaster $reportMaster,$startDate, $endDate, $pageSize = null, $pageOrientation =null,$options = false)
    {
        $this->reportMaster = $reportMaster;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->options = $options;
        if($pageSize != null )
        {
            $this->reportMaster->papersize = $pageSize;   
        }
        if($pageOrientation != null)
        {
            $this->reportMaster->orientation = $pageOrientation;   
        }
        
        if($this->reportMaster->viewname == null || $this->reportMaster->viewname == "")
        {
            $this->reportMaster->viewname = $this->defaultViewName;
        }
    }

    public function setup(){

    }

    public function html(){
        if(!$this->setupDone){
            $this->setup();
        }
        return view($this->reportMaster->viewname)->with('report',$this);
    }

    public function viewPDF(){

        if(!$this->setupDone){
            $this->setup();
        }

        $this->generatePDF();

        return $this->pdf->stream();
    }

    public function generatePDF()
    {
        $this->pdf = PDF::loadView($this->reportMaster->viewname,['report'=>$this])
            ->setPaper($this->reportMaster->papersize, $this->reportMaster->orientation);
    }

    public function downloadPDF(){
        if(!$this->setupDone){
            $this->setup();
        }

        $this->generatePDF();

        return $this->pdf->download();

    }

    public function downloadCSV(){

    }

    public function viewCSV(){

    }

    public function results()
    {
        return [
            'columns' => $this->columns,
            'displayData' => $this->data,
            'reportTotals' => $this->totals,
        ];
    }

    public function getReportName(){
        return  $this->name.'-'.$this->startDate.'-'.$this->endDate.'-'.Carbon::now()->toDateTimeString();
    }

}
