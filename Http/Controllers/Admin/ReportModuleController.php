<?php

namespace Modules\Reports\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Reports\Entities\ReportModule;
use Modules\Reports\Http\Requests\CreateReportModuleRequest;
use Modules\Reports\Http\Requests\UpdateReportModuleRequest;
use Modules\Reports\Repositories\ReportModuleRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;

class ReportModuleController extends AdminBaseController
{
    /**
     * @var ReportModuleRepository
     */
    private $reportmodule;

    private $auth;
    public function __construct(ReportModuleRepository $reportmodule,Authentication $auth)
    {
        parent::__construct();

        $this->reportmodule = $reportmodule;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $reportmodules = $this->reportmodule->all();

        return view('reports::admin.reportmodules.index', compact('reportmodules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('reports::admin.reportmodules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateReportModuleRequest $request
     * @return Response
     */
    public function store(CreateReportModuleRequest $request)
    {
        $this->reportmodule->create($request->all());

        return redirect()->route('admin.reports.reportmodule.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('reports::reportmodules.title.reportmodules')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ReportModule $reportmodule
     * @return Response
     */
    public function edit(ReportModule $reportmodule)
    {
        return view('reports::admin.reportmodules.edit', compact('reportmodule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ReportModule $reportmodule
     * @param  UpdateReportModuleRequest $request
     * @return Response
     */
    public function update(ReportModule $reportmodule, UpdateReportModuleRequest $request)
    {
        $reportmodule = $this->reportmodule->find($request->reportmodule_id);
        $this->reportmodule->update($reportmodule, $request->all());

        return redirect()->route('admin.reports.reportmodule.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('reports::reportmodules.title.reportmodules')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ReportModule $reportmodule
     * @return Response
     */
    public function destroy(ReportModule $reportmodule)
    {
        $this->reportmodule->destroy($reportmodule);

        return redirect()->route('admin.reports.reportmodule.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('reports::reportmodules.title.reportmodules')]));
    }
}
