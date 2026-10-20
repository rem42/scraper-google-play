<?php

declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Utils;

use Scraper\Scraper\Exception\ScraperException;

final class ScriptData
{
    /**
     * Extracts the JSON data of an "AF_initDataCallback" block (e.g. key "ds:5") embedded in a Google Play page.
     *
     * @return array<mixed>
     *
     * @throws ScraperException
     */
    public static function extract(string $html, string $key): array
    {
        $pattern = "/AF_initDataCallback\\(\\{key: '" . preg_quote($key, '/') . "'.*?data:(.*?), sideChannel: \\{\\}\\}\\);/s";

        if (1 !== preg_match($pattern, $html, $matches)) {
            throw new ScraperException(\sprintf('Cannot find "%s" data in the Google Play page', $key));
        }

        $data = json_decode($matches[1], true, 512, \JSON_THROW_ON_ERROR);

        if (!\is_array($data)) {
            throw new ScraperException(\sprintf('Invalid "%s" data in the Google Play page', $key));
        }

        return $data;
    }
}
