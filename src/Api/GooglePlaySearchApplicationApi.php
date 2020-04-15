<?php

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayApplication;
use Scraper\ScraperGooglePlay\Entity\GooglePlayDeveloper;

class GooglePlaySearchApplicationApi extends AbstractApi
{
    public function execute(): array
    {
        $content = $this->response->getContent();

        $content = json_decode(substr($content, 6));

        $content = json_decode($content[0][2]);

        $apps = $content[0][1][0][0][0];

        $data = [];

        foreach ($apps as $app) {
            $a = new GooglePlayApplication();

            $a->packageName = $app[12][0];
            $a->name        = $app[2];
            $a->cover       = $app[1][1][0][3][2];
            $a->description = $app[4][1][1][1][1];
            $a->type        = GooglePlayApplication::FREE;
            $a->link        = $app[9][4][2];
            $a->rating      = $app[6][0][2][1][0];
            $a->ratingFloat = $app[6][0][2][1][1];

            $d       = new GooglePlayDeveloper();
            $d->name = $app[4][0][0][0];
            $d->link = $app[4][0][0][1][4][2];

            $a->developer = $d;

            if (null !== $app[7] && count($app[7])) {
                $a->type           = GooglePlayApplication::PAID;
                $a->price          = $app[7][0][3][2][1][0][0];
                $a->priceFormatted = $app[7][0][3][2][1][0][2];
                $a->currency       = $app[7][0][3][2][1][0][1];
                $a->buyLink        = $app[7][0][3][2][6][5][2];
            }

            $data[] = $a;
        }

        return $data;
    }
}
