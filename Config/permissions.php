<?php

return [

    'reports.module'=>[
        'index' => 'Show Reports Module',
        'admin' => "Manage Reports"
    ],

    'reports.reportmasters' => [
        'index' => 'reports::reportmasters.list resource',
        'create' => 'reports::reportmasters.create resource',
        'edit' => 'reports::reportmasters.edit resource',
        'destroy' => 'reports::reportmasters.destroy resource',
    ],
    'reports.reportmodules' => [
        'index' => 'reports::reportmodules.list resource',
        'create' => 'reports::reportmodules.create resource',
        'edit' => 'reports::reportmodules.edit resource',
        'destroy' => 'reports::reportmodules.destroy resource',
    ],
    'reports.reportparameters' => [
        'index' => 'reports::reportparameters.list resource',
        'create' => 'reports::reportparameters.create resource',
        'edit' => 'reports::reportparameters.edit resource',
        'destroy' => 'reports::reportparameters.destroy resource',
    ],
    'reports.reportlogs' => [
        'index' => 'reports::reportlogs.list resource',
        'create' => 'reports::reportlogs.create resource',
        'edit' => 'reports::reportlogs.edit resource',
        'destroy' => 'reports::reportlogs.destroy resource',
        'generate' => 'reports::reportlogs.generate report',
    ],
// append




];
