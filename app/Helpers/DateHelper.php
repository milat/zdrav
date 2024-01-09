<?php

namespace App\Helpers;

use DateTime;
use Illuminate\Support\Facades\Auth;

abstract class DateHelper
{
    /**
     * @param string $date
     * @param bool $hasTime
     * @return string
     */
    public static function convertFormat(string $date, bool $hasTime = false): string
    {
        $dbFormat = 'Y-m-d';
        $userPreferenceFormat = Auth::user()->preferences->dateFormat->format;

        if ($hasTime) {
            $dbFormat .= ' H:i:s';
            $userPreferenceFormat .= ' H:i:s';
        }

        $dateObj = DateTime::createFromFormat($dbFormat, $date);

        if ($dateObj === false) {
            return $date;
        }

        return $dateObj->format($userPreferenceFormat);
    }
}
