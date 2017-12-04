<?php

namespace Modules\Reports\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Libraries\Utils;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Modules\Page\Repositories\PageRepository;
use Modules\Process\Repositories\ProductRepository;
use Modules\Reports\Entities\ReportLog;
use Modules\Reports\Http\Requests\CreateReportLogRequest;
use Modules\Reports\Http\Requests\UpdateReportLogRequest;
use Modules\Reports\Repositories\ReportLogRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Reports\Repositories\ReportMasterRepository;
use Modules\Reports\Repositories\ReportModuleRepository;
use Modules\Reports\Repositories\ReportParameterRepository;
use Str;
use PDF;

class ReportLogController extends AdminBaseController
{
    /**
     * @var ReportLogRepository
     */
    private $reportlog;

    /**
     * @var ReportMasterRepository
     */
    private $reportMaster;

    public function __construct(ReportLogRepository $reportlog,ReportMasterRepository $reportMaster)
    {
        parent::__construct();

        $this->reportlog = $reportlog;
        $this->reportMaster = $reportMaster;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($module)
    {
        $reports = $this->reportMaster->allWithBuilder()
            ->where('module_id','=',$module)
            ->pluck('name','id');

        return view('reports::admin.reportlogs.index', compact('reports'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('reports::admin.reportlogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateReportLogRequest $request
     * @return Response
     */
    public function store(CreateReportLogRequest $request)
    {
        $this->reportlog->create($request->all());

        return redirect()->route('admin.reports.reportlog.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('reports::reportlogs.title.reportlogs')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ReportLog $reportlog
     * @return Response
     */
    public function edit(ReportLog $reportlog)
    {
        return view('reports::admin.reportlogs.edit', compact('reportlog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ReportLog $reportlog
     * @param  UpdateReportLogRequest $request
     * @return Response
     */
    public function update(ReportLog $reportlog, UpdateReportLogRequest $request)
    {
        $this->reportlog->update($reportlog, $request->all());

        return redirect()->route('admin.reports.reportlog.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('reports::reportlogs.title.reportlogs')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ReportLog $reportlog
     * @return Response
     */
    public function destroy(ReportLog $reportlog)
    {
        $this->reportlog->destroy($reportlog);

        return redirect()->route('admin.reports.reportlog.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('reports::reportlogs.title.reportlogs')]));
    }

    /**
     * Generate new report
     *
     * @param Request $request
     * @return mixed
     */
    public function generate(Request $request)
    {
        $reportType = app(ReportMasterRepository::class)->find($request->input('report_Type'));
        $reportClass = 'Modules\\Reports\\Reports\\'.Str::studly($reportType->class).'Report';

        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));
        $report = new $reportClass($reportType,$startDate, $endDate,true);

        return $report->viewPDF();
    }
}
