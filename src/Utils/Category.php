<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Utils;

final class Category
{
    public static string $APPS = 'apps';
    public static string $MOVIES = 'movies';
    public static string $MUSIC = 'music';
    public static string $BOOKS = 'books';
    public static string $NEWSSTAND = 'newsstand';
    public static string $DEVICES = 'devices';

    /**
     * @return array<int, string>
     */
    public static function list(): array
    {
        return [
            self::$APPS,
            self::$MOVIES,
            self::$MUSIC,
            self::$BOOKS,
            self::$NEWSSTAND,
            self::$DEVICES,
        ];
    }
}
