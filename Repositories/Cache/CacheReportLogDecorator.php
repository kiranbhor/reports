<?php

namespace Modules\Reports\Repositories\Cache;

use Modules\Reports\Repositories\ReportLogRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheReportLogDecorator extends BaseCacheDecorator implements ReportLogRepository
{
    public function __construct(ReportLogRepository $reportlog)
    {
        parent::__construct();
        $this->entityName = 'reports.reportlogs';
        $this->repository = $reportlog;
    }
}
