<?php

namespace App\Helpers;

use DateTime;
use Carbon\Carbon;

class DateTimeHelper {

    public static function DayDateFormat($date) {
        $date_formatted = DateTime::createFromFormat('Y-m-d', $date);
        return $date_formatted->format('l').' - '.$date_formatted->format('d F Y');
    }

    public static function FullTimeFormat($date) {
        $date_formatted = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        return $date_formatted->format('l').' - '.$date_formatted->format('d F Y H:i:s');
    }

    public static function DayDateFormatID($date) {
        $new_date = Carbon::parse($date)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY'); ;
        return $new_date;
    }

    public static function FullTimeFormatID($date) {
        $new_date = Carbon::parse($date)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY HH:mm:ss'); ;
        return $new_date;
    }

}
