<?php

namespace App\Traits;

trait DateTrait
{
    /**
     * Convert Jalalian Date to Georgian Date
     * 
     * @param string $date
     * @return string
     */
    public function convertToGeorgianDate($date)
    {
        $date = $this->convertNumberToEnglish($date);
        $dateString = \Morilog\Jalali\CalendarUtils::convertNumbers($date, true);
        return \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y-m-d', $dateString)->format('Y-m-d');
    }

    /**
     * Convert Persian and Arabic Numbers to English Numbers
     * 
     * @param string $string
     * @return string
     */
    public function convertNumberToEnglish($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);
        return $this->cleanDateString($englishNumbersOnly);
    }

    /**
     * Remove any characters except digits and dashes
     * 
     * @param string $dateString
     * @return string
     */
    public function cleanDateString($dateString)
    {
        return preg_replace('/[^0-9\-]/', '', $dateString);
    }
}
