<?php

namespace Scraper\ScraperGooglePlay\Utils;

final class Tools
{
    /** @var string[] */
    private const FRENCH_DAYS = ['Lundi',    'Mardi',    'Mercredi',     'Jeudi',    'Vendredi',     'Samedi',   'Dimanche'];
    /** @var string[] */
    private const ENGLISH_DAYS = ['Monday',   'Tuesday',  'Wednesday',    'Thursday', 'Friday',       'Saturday', 'Sunday'];
    /** @var string[] */
    private const FRENCH_MONTHS = ['Janvier',  'Février',  'Mars',     'Avril', 'Mai', 'Juin', 'Juillet',  'Août',     'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    /** @var string[] */
    private const ENGLISH_MONTHS = ['January',  'February', 'March',    'April', 'May', 'June', 'July',     'August',   'September', 'October', 'November', 'December'];

    /**
     * @param $date
     *
     * @return mixed|string|string[]|null
     */
    public static function frenchDateToEnglish($date): string
    {
        $date         = mb_strtolower($date);
        $date         = ucwords($date);
        $date         = str_replace(self::FRENCH_DAYS, self::ENGLISH_DAYS, $date);

        return str_replace(self::FRENCH_MONTHS, self::ENGLISH_MONTHS, $date);
    }
}
