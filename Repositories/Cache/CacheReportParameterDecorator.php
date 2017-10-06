<?php

namespace Modules\Reports\Repositories\Cache;

use Modules\Reports\Repositories\ReportParameterRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheReportParameterDecorator extends BaseCacheDecorator implements ReportParameterRepository
{
    public function __construct(ReportParameterRepository $reportparameter)
    {
        parent::__construct();
        $this->entityName = 'reports.reportparameters';
        $this->repository = $reportparameter;
    }
}
