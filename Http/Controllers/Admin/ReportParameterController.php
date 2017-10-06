<?php

namespace Modules\Reports\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Reports\Entities\ReportParameter;
use Modules\Reports\Http\Requests\CreateReportParameterRequest;
use Modules\Reports\Http\Requests\UpdateReportParameterRequest;
use Modules\Reports\Repositories\ReportParameterRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ReportParameterController extends AdminBaseController
{
    /**
     * @var ReportParameterRepository
     */
    private $reportparameter;

    public function __construct(ReportParameterRepository $reportparameter)
    {
        parent::__construct();

        $this->reportparameter = $reportparameter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$reportparameters = $this->reportparameter->all();

        return view('reports::admin.reportparameters.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('reports::admin.reportparameters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateReportParameterRequest $request
     * @return Response
     */
    public function store(CreateReportParameterRequest $request)
    {
        $this->reportparameter->create($request->all());

        return redirect()->route('admin.reports.reportparameter.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('reports::reportparameters.title.reportparameters')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ReportParameter $reportparameter
     * @return Response
     */
    public function edit(ReportParameter $reportparameter)
    {
        return view('reports::admin.reportparameters.edit', compact('reportparameter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ReportParameter $reportparameter
     * @param  UpdateReportParameterRequest $request
     * @return Response
     */
    public function update(ReportParameter $reportparameter, UpdateReportParameterRequest $request)
    {
        $this->reportparameter->update($reportparameter, $request->all());

        return redirect()->route('admin.reports.reportparameter.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('reports::reportparameters.title.reportparameters')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ReportParameter $reportparameter
     * @return Response
     */
    public function destroy(ReportParameter $reportparameter)
    {
        $this->reportparameter->destroy($reportparameter);

        return redirect()->route('admin.reports.reportparameter.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('reports::reportparameters.title.reportparameters')]));
    }
}
