<?php


namespace Modules\Reports\Reports;


use Carbon\Carbon;
use PDF;

class AbstractReport
{

    public $startDate;
    public $endDate;
    public $isExport;
    public $options;

    public $title;
    public $subtitle;
    public $subFooter;
    public $footer;
    public $createdBy;


    public $viewName = 'reports::reports.report';
    public $pageSize;
    public $pageOrientation;


    public $totals = [];
    public $columns = [];
    public $data;

    public $name;

    public $pdf;
    public $csv;

    public $setupDone;

    public function __construct($startDate, $endDate, $isExport, $pageSize = 'a4', $pageOrientation ='portrait',$options = false)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->isExport = $isExport;
        $this->options = $options;
        $this->pageSize = $pageSize;
        $this->pageOrientation = $pageOrientation;
    }

    public function setup(){

    }

    public function html(){
        if(!$this->setupDone){
            $this->setup();
        }
        return view($this->viewName)->with('report',$this);
    }

    public function viewPDF(){

        if(!$this->setupDone){
            $this->setup();
        }

        $this->pdf = PDF::loadView($this->viewName,['report'=>$this])->setPaper($this->pageSize, $this->pageOrientation);

        return $this->pdf->stream();
    }

    public function downloadPDF(){
        if(!$this->setupDone){
            $this->setup();
        }

        $this->pdf = PDF::loadView($this->viewName,['report'=>$this])->setPaper($this->pageSize, $this->pageOrientation);

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