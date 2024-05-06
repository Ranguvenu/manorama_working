<?php

use Carbon\Carbon;

if (!function_exists('format_bytes')) {
    function format_bytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = [' bytes', ' KB', ' MB', ' GB', ' TB'];

            return round(pow(1024, $base - floor($base)), $precision).$suffixes[floor($base)];
        } else {
            return $size;
        }
    }
}

if (!function_exists('get_date')) {
    function get_date($timestamp, $format = '')
    {
        $format = $format ? $format : 'M d, Y';

        return Carbon::parse($timestamp)->format($format);
    }
}

if (!function_exists('get_date_time')) {
    function get_date_time($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y/m/d h:i A');
    }
}

if (!function_exists('is_data_serialized')) {
    function is_data_serialized($data)
    {
        $string = @unserialize($data);

        return ($string !== false) ? true : false;
    }
}

if (!function_exists('get_date_diff')) {
    function get_date_diff($start, $end)
    {
        $startdate = Carbon::parse($start);
        $enddate = Carbon::parse($end);

        return $startdate->diff($enddate)->days;
    }
}

if (!function_exists('array_combine_unequal')) {
    function array_combine_unequal($variables, $values)
    {
        $result = [];
        foreach ($variables as $key => $value) {
            if (isset($values[$key])) {
                $result[$value] = $values[$key];
            } else {
                $result[$value] = '';
            }
        }

        return $result;
    }
}
