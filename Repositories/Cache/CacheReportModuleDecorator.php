<?php

namespace Modules\Reports\Repositories\Cache;

use Modules\Reports\Repositories\ReportModuleRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheReportModuleDecorator extends BaseCacheDecorator implements ReportModuleRepository
{
    public function __construct(ReportModuleRepository $reportmodule)
    {
        parent::__construct();
        $this->entityName = 'reports.reportmodules';
        $this->repository = $reportmodule;
    }
}
