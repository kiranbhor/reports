<?php

namespace Modules\Reports\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Reports\Entities\ReportModule;
use Modules\Reports\Entities\ReportParameter;
use Modules\Reports\Events\Handlers\RegisterReportsSidebar;
use Modules\Reports\Repositories\ReportLogRepository;
use Modules\Reports\Repositories\ReportMasterRepository;
use Modules\Reports\Repositories\ReportModuleRepository;
use Modules\Reports\Repositories\ReportParameterRepository;

class ReportsServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterReportsSidebar::class);
    }

    public function boot()
    {
        $this->publishConfig('reports', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            ReportMasterRepository::class,
            function () {
                $repository = new \Modules\Reports\Repositories\Eloquent\EloquentReportMasterRepository(new \Modules\Reports\Entities\ReportMaster());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Reports\Repositories\Cache\CacheReportMasterDecorator($repository);
            }
        );
        $this->app->bind(
            ReportModuleRepository::class,
            function () {

                $repository = new \Modules\Reports\Repositories\Eloquent\EloquentReportModuleRepository(new \Modules\Reports\Entities\ReportModule());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Reports\Repositories\Cache\CacheReportModuleDecorator($repository);
            }
        );
        $this->app->bind(
            ReportParameterRepository::class,
            function () {
                $repository = new \Modules\Reports\Repositories\Eloquent\EloquentReportParameterRepository(new \Modules\Reports\Entities\ReportParameter());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Reports\Repositories\Cache\CacheReportParameterDecorator($repository);
            }
        );

        $this->app->bind(
            ReportLogRepository::class,
            function () {
                $repository = new \Modules\Reports\Repositories\Eloquent\EloquentReportLogRepository(new \Modules\Reports\Entities\ReportLog());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Reports\Repositories\Cache\CacheReportLoDecorator($repository);
            }
        );
// add bindings



    }
}
