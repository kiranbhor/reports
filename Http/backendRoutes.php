<?php

use Illuminate\Routing\Router;
use Modules\Reports\Repositories\ReportLogRepository;
/** @var Router $router */

$router->group(['prefix' =>'/reports'], function (Router $router) {
    $router->bind('reportmaster', function ($id) {
        return app('Modules\Reports\Repositories\ReportMasterRepository')->find($id);
    });
    $router->get('reportmasters', [
        'as' => 'admin.reports.reportmaster.index',
        'uses' => 'ReportMasterController@index',
        'middleware' => 'can:reports.reportmasters.index'
    ]);
    $router->get('reportmasters/create', [
        'as' => 'admin.reports.reportmaster.create',
        'uses' => 'ReportMasterController@create',
        'middleware' => 'can:reports.reportmasters.create'
    ]);
    $router->post('reportmasters', [
        'as' => 'admin.reports.reportmaster.store',
        'uses' => 'ReportMasterController@store',
        'middleware' => 'can:reports.reportmasters.create'
    ]);
    $router->get('reportmasters/{reportmaster}/edit', [
        'as' => 'admin.reports.reportmaster.edit',
        'uses' => 'ReportMasterController@edit',
        'middleware' => 'can:reports.reportmasters.edit'
    ]);
    $router->put('reportmasters/{reportmaster}', [
        'as' => 'admin.reports.reportmaster.update',
        'uses' => 'ReportMasterController@update',
        'middleware' => 'can:reports.reportmasters.edit'
    ]);
    $router->post('reportmasters/update', [
        'as' => 'admin.reports.reportmaster.update',
        'uses' => 'ReportMasterController@update',
        'middleware' => 'can:reports.reportmasters.edit'
    ]);
    $router->delete('reportmasters/{reportmaster}', [
        'as' => 'admin.reports.reportmaster.destroy',
        'uses' => 'ReportMasterController@destroy',
        'middleware' => 'can:reports.reportmasters.destroy'
    ]);

    $router->bind('reportmodule', function ($id) {
        return app('Modules\Reports\Repositories\ReportModuleRepository')->find($id);
    });
    $router->get('reportmodules', [
        'as' => 'admin.reports.reportmodule.index',
        'uses' => 'ReportModuleController@index',
        'middleware' => 'can:reports.reportmodules.index'
    ]);
    $router->get('reportmodules/create', [
        'as' => 'admin.reports.reportmodule.create',
        'uses' => 'ReportModuleController@create',
        'middleware' => 'can:reports.reportmodules.create'
    ]);
    $router->post('reportmodules', [
        'as' => 'admin.reports.reportmodule.store',
        'uses' => 'ReportModuleController@store',
        'middleware' => 'can:reports.reportmodules.create'
    ]);
    $router->get('reportmodules/{reportmodule}/edit', [
        'as' => 'admin.reports.reportmodule.edit',
        'uses' => 'ReportModuleController@edit',
        'middleware' => 'can:reports.reportmodules.edit'
    ]);
    $router->put('reportmodules/{reportmodule}', [
        'as' => 'admin.reports.reportmodule.update',
        'uses' => 'ReportModuleController@update',
        'middleware' => 'can:reports.reportmodules.edit'
    ]);
    $router->post('reportmodules/update', [
        'as' => 'admin.reports.reportmodule.update',
        'uses' => 'ReportModuleController@update',
        'middleware' => 'can:reports.reportmodules.edit'
    ]);
    $router->delete('reportmodules/{reportmodule}', [
        'as' => 'admin.reports.reportmodule.destroy',
        'uses' => 'ReportModuleController@destroy',
        'middleware' => 'can:reports.reportmodules.destroy'
    ]);
    $router->bind('reportparameter', function ($id) {
        return app('Modules\Reports\Repositories\ReportParameterRepository')->find($id);
    });
    $router->get('reportparameters', [
        'as' => 'admin.reports.reportparameter.index',
        'uses' => 'ReportParameterController@index',
        'middleware' => 'can:reports.reportparameters.index'
    ]);
    $router->get('reportparameters/create', [
        'as' => 'admin.reports.reportparameter.create',
        'uses' => 'ReportParameterController@create',
        'middleware' => 'can:reports.reportparameters.create'
    ]);
    $router->post('reportparameters', [
        'as' => 'admin.reports.reportparameter.store',
        'uses' => 'ReportParameterController@store',
        'middleware' => 'can:reports.reportparameters.create'
    ]);
    $router->get('reportparameters/{reportparameter}/edit', [
        'as' => 'admin.reports.reportparameter.edit',
        'uses' => 'ReportParameterController@edit',
        'middleware' => 'can:reports.reportparameters.edit'
    ]);
    $router->put('reportparameters/{reportparameter}', [
        'as' => 'admin.reports.reportparameter.update',
        'uses' => 'ReportParameterController@update',
        'middleware' => 'can:reports.reportparameters.edit'
    ]);
    $router->delete('reportparameters/{reportparameter}', [
        'as' => 'admin.reports.reportparameter.destroy',
        'uses' => 'ReportParameterController@destroy',
        'middleware' => 'can:reports.reportparameters.destroy'
    ]);
    $router->bind('reportlog', function ($id) {
        return app(ReportLogRepository::class)->find($id);
    });
    $router->get('reports/{id}', [
        'as' => 'admin.reports.reportlog.index',
        'uses' => 'ReportLogController@index',
        'middleware' => 'can:reports.reportlogs.index'
    ]);
    $router->get('reportlogs/create', [
        'as' => 'admin.reports.reportlog.create',
        'uses' => 'ReportLogController@create',
        'middleware' => 'can:reports.reportlogs.create'
    ]);
    $router->post('reportlogs', [
        'as' => 'admin.reports.reportlog.store',
        'uses' => 'ReportLogController@store',
        'middleware' => 'can:reports.reportlogs.create'
    ]);
    $router->get('reportlogs/{reportlog}/edit', [
        'as' => 'admin.reports.reportlog.edit',
        'uses' => 'ReportLogController@edit',
        'middleware' => 'can:reports.reportlogs.edit'
    ]);
    $router->put('reportlogs/{reportlog}', [
        'as' => 'admin.reports.reportlog.update',
        'uses' => 'ReportLogController@update',
        'middleware' => 'can:reports.reportlogs.edit'
    ]);
    $router->delete('reportlogs/{reportlog}', [
        'as' => 'admin.reports.reportlog.destroy',
        'uses' => 'ReportLogController@destroy',
        'middleware' => 'can:reports.reportlogs.destroy'
    ]);
    $router->post('/generate', [
        'as' => 'admin.report.generate',
        'uses' => 'ReportLogController@generate',
        'middleware' => 'can:reports.reportlogs.generate'
    ]);
// append




});
