<?php
namespace App\Helpers;

use NumberFormatter;

class Money {

    public static function format($value){
        $formater = new NumberFormatter('en', NumberFormatter::CURRENCY);
        return $formater->formatCurrency($value, 'ILS');
    }
}
