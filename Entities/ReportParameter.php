<?php

namespace Modules\Reports\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ReportParameter extends Model
{

    use Translatable;

    protected $table = 'reports__reportparameters';
    public $translatedAttributes = [];
    protected $fillable = [];
}
