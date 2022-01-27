<?php

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;

final class GooglePlaySearchApi extends AbstractApi
{
    public function execute(): array
    {
        $content = $this->response->getContent();

        $content = json_decode(substr($content, 6));

        $content = json_decode($content[0][2]);

        dump($content);
        die('');
    }
}
