<?php

namespace Scraper\ScraperGooglePlay\Utils;

final class Category
{
    /** @var string */
    const APPS      = 'apps';
    /** @var string */
    const MOVIES    = 'movies';
    /** @var string */
    const MUSIC     = 'music';
    /** @var string */
    const BOOKS     = 'books';
    /** @var string */
    const NEWSSTAND = 'newsstand';
    /** @var string */
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
