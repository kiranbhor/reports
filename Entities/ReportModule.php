<?php

namespace Modules\Reports\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportModule extends Model
{

    use SoftDeletes;

    protected $table = 'reports__reportmodules';
    public $translatedAttributes = [];
    protected $fillable = [
        'name',
        'order',
        'css_class'
    ];
}
