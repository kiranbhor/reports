<?php

namespace Modules\Reports\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ReportMaster extends Model
{

    protected $table = 'reports__reportmasters';
    public $translatedAttributes = [];
    protected $fillable = [
        'name',
        'module_id',
        'query',
        'orientation',
        'papersize',
        'type',
        'class',
        'template_file_id',
        'frequency',
        'is_mnth_gnrtn',
        'export_formats',
        'code'
    ];
}
