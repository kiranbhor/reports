<?php

namespace Modules\Reports\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ReportLog extends Model
{

    use Translatable;

    protected $table = 'reports__reportlogs';
    public $translatedAttributes = [];
    protected $fillable = [];
}
