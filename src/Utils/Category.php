<?php

namespace Scraper\ScraperGooglePlay\Utils;

class Category
{
    const APPS      = 'apps';
    const MOVIES    = 'movies';
    const MUSIC     = 'music';
    const BOOKS     = 'books';
    const NEWSSTAND = 'newsstand';
    const DEVICES   = 'devices';

    public static function list(): array
    {
        return [
            self::APPS,
            self::MOVIES,
            self::MUSIC,
            self::BOOKS,
            self::NEWSSTAND,
            self::DEVICES,
        ];
    }
}
