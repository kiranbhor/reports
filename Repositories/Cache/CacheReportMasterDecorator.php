<?php

namespace Modules\Reports\Repositories\Cache;

use Modules\Reports\Repositories\ReportMasterRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheReportMasterDecorator extends BaseCacheDecorator implements ReportMasterRepository
{
    public function __construct(ReportMasterRepository $reportmaster)
    {
        parent::__construct();
        $this->entityName = 'reports.reportmasters';
        $this->repository = $reportmaster;
    }
}
