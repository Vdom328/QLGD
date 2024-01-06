<?php

use App\Classes\Enum\CompanyDateEnum;
use App\Models\User;
use App\Models\ControlDailyNote;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

if (!function_exists('formatDate')) {
    function formatDate($date, string $format = 'Y/m/d')
    {
        if (gettype($date) == "string") {
            $date = \Carbon\Carbon::parse($date);
        }

        if ($date instanceof \Carbon\Carbon) {
            return $date->format($format);
        }

        return $date;
    }
}

/**
 * split csv column from 1 line
 * @param string line
 * @return array columns
 */
function skReadCsvFromLine(string $line): array
{
    // format line to utf-8
    $encoding = mb_detect_encoding($line, "auto");
    if (!$encoding) {
        $encoding = mb_detect_encoding($line, "JIS, eucjp-win, sjis-win, UTF-8, SJIS");
    }
    if ($encoding != "UTF-8") {
        $line = mb_convert_encoding($line, "UTF-8", $encoding);
    }
    // get text in quotes
    $pattern = '/"(.*?)"/';
    preg_match_all($pattern, $line, $matches);
    $lineReplacePattern = [];
    $lineReplcaeKey = [];
    $lineReplaceValue = [];
    $aryCsvReplaceValue = [];
    if (isset($matches[0])) {
        $lineReplaceValue = $matches[0]; // text in quotes with quotes
        $aryCsvReplaceValue = $matches[1]; // text in quotes without quotes
        foreach ($lineReplaceValue as $key => $value) {
            /**
             * create array replace and pattern to use explode
             */
            $lineReplacePattern[] = '/(' . 'sk_replace_' . $key . ')/';
            $lineReplcaeKey[] = 'sk_replace_' . $key;
        }
    }

    $line = str_replace($lineReplaceValue, $lineReplcaeKey, $line);
    $ary = explode(",", str_replace(['"', "\n"], '', $line));
    return preg_replace($lineReplacePattern, $aryCsvReplaceValue, $ary);
}



/**
 * First character of user name
 * @param string $name
 * @return string
 */
if (!function_exists('initialsOfUser')) {
    function initialsOfUser($name)
    {
        return mb_substr($name, 0, 1);
    }
}

/**
 * Convert a value to a number.
 *
 * @param mixed $value The value to convert.
 * @return int The converted number.
 */
if (!function_exists('convertInputMaskToNumber')) {
    function convertInputMaskToNumber($value)
    {
        $numberValue = preg_replace('/\D/', '', $value);
        $parsedNumber = intval($numberValue);
        return $value = $parsedNumber;
    }
}

/**
 * check role edit profile
 */
function isAdmin() {
    if (Auth::user()->roleUser->role_id == 1) {
        return true;
    }
    return false;
}

/**
 * format number
 */
function formatNumber($number)
{
    if ($number == 0) {
        return '';
    } else if ($number == intval($number)) {
        return number_format($number);
    } else {
        return number_format($number, 1);
    }
}

function time_slots()
{
    $setting = Settings::where('id',1)->first();
    return $setting->time_slots;
}
function paginate()
{
    $setting = Settings::where('id',1)->first();
    return $setting->paginate;
}

