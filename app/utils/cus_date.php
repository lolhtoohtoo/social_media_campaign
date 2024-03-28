<?php
namespace Utils;

class CusDate {
    public function getCurrentDateUTC() : String{
        $currentDateTimeUTC = gmdate("Y-m-d H:i:s");
        return $currentDateTimeUTC;
    }
}