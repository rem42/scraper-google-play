<?php

namespace Scraper\ScraperGooglePlay\Utils;


class Tools
{
	/**
	 * @param $date
	 * @return mixed|null|string|string[]
	 */
    public static function frenchDateToEnglish($date){
        $date = mb_strtolower($date);
        $date = ucwords($date);

        $french_days = [    'Lundi',    'Mardi',    'Mercredi',     'Jeudi',    'Vendredi',     'Samedi',   'Dimanche'];
        $english_days = [   'Monday',   'Tuesday',  'Wednesday',    'Thursday', 'Friday',       'Saturday', 'Sunday'];
        $date = str_replace($french_days, $english_days, $date);

        $french_months = [  'Janvier',  'Février',  'Mars',     'Avril', 'Mai', 'Juin', 'Juillet',  'Août',     'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        $english_months = [ 'January',  'February', 'March',    'April', 'May', 'June', 'July',     'August',   'September', 'October', 'November', 'December'];

        $date = str_replace($french_months, $english_months, $date);

        return $date;
    }
}
