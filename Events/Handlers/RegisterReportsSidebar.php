<?php

namespace Modules\Reports\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\Reports\Entities\ReportModule;
use Modules\User\Contracts\Authentication;

class RegisterReportsSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('reports::reports.title.report list'), function (Item $item) {
                $item->icon('fa fa-bar-chart');
                $item->weight(10);
                $item->authorize(
                     'reports.module.admin'
                );
                $reportModules = app(ReportModule::class)->orderBy('order','asc')->get();

                foreach ($reportModules as $reportModule) {
                    $item->item(trans($reportModule->name),function (Item $item) use($reportModule) {
                        $item->icon($reportModule->icon_class);
                        $item->weight((int)$reportModule->order);
                        $item->append('admin.reports.reportlog.create');
                        $item->route('admin.reports.reportlog.index',$reportModule->id);
                        $item->authorize(
                            $this->auth->hasAccess('reports.reportlogs.index')
                        );
                    });
                }
            });

            $group->item(trans('reports::reports.title.name'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                    'reports.module.index'
                );
                $item->item(trans('reports::reportmasters.title.reportmasters'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.reports.reportmaster.create');
                    $item->route('admin.reports.reportmaster.index');
                    $item->authorize(
                        $this->auth->hasAccess('reports.reportmasters.index')
                    );
                });

                $item->item(trans('reports::reportmodules.title.reportmodules'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.reports.reportmodule.create');
                    $item->route('admin.reports.reportmodule.index');
                    $item->authorize(
                        $this->auth->hasAccess('reports.reportmodules.index')
                    );
                });
                $item->item(trans('reports::reportparameters.title.reportparameters'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.reports.reportparameter.create');
                    $item->route('admin.reports.reportparameter.index');
                    $item->authorize(
                        $this->auth->hasAccess('reports.reportparameters.index')
                    );
                });
            });
        });

        return $menu;
    }
}
