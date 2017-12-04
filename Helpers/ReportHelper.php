<?php


if(!defined('REPORT_MODULE')) {
    define('REPORT_MODULE', 'REPORT_MODULE');

    //Column Formats
    define('REPORT_DATE_FORMAT', 'DATE');
    define('REPORT_DATETIME_FORMAT', 'DATE_TIME');
    define('REPORT_CURRENCY_FORMAT', 'CURRENCY');

    //Column Types
    define('REPORT_ROWNO_COLUMN', 'ROW_NO');
    define('REPORT_RELATION_COLUMN', 'RELATION');
    define('REPORT_MULRELATION_COLUMN', 'MULRELATION');
    //functions
    define('MODEL_ATTRIBUTE_AS_STRING', 'modelAttributeToCSString');
    define('MODEL_ATTRIBUTE_FROM_RELATION', 'modelAttribute');
    define('MODEL_ATTRIBUTE_FROM_INDEX', 'getAttribute');
    //paper size
    define('PAPER_SIZE_A1','A1');
    define('PAPER_SIZE_A2','A2');
    define('PAPER_SIZE_A3','A3');
    define('PAPER_SIZE_A4','A4');
    define('PAPER_SIZE_LEAGAL', 'LEAGAL');

    //paper orientation
    define('ORIENTATION_LANDSCAPE','landscape');
    define('ORIENTATION_PORTRAIT','portrait');
}

function modelAttributeToCSString($models,$attribute){
    return (implode(",", collect($models->toArray())->pluck($attribute)->all()));
}

function formatValue($value,$format){

    if(!isset($value)){
        return "";
    }
    switch ($format){
        case "DATE":
            return \Carbon\Carbon::parse($value)->format(PHP_DATE_FORMAT);
            break;
        case "DATE_TIME":
            return \Carbon\Carbon::parse($value)->format(PHP_DATE_TIME_FORMAT);
            break;
        case "CURRENCY":
            return "Rs ".$value;
            break;
        default:
            return $value;
    }
}
