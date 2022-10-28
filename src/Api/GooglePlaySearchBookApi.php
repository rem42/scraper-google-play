<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayApp;
use Scraper\ScraperGooglePlay\Entity\GooglePlayDeveloper;
use Scraper\ScraperGooglePlay\Entity\GooglePlayImage;
use Scraper\ScraperGooglePlay\Utils\Price;

final class GooglePlaySearchBookApi extends AbstractApi
{
    /**
     * @return array<int, GooglePlayApp>
     */
    public function execute(): array
    {
        /** @var array $content */
        $content = json_decode(substr($this->response->getContent(), 6), false);

        /** @var array $content */
        $content = json_decode($content[0][2], false);

        /** @var array $apps */
        $apps = $content[0][1][0][0][0];

        $data = [];

        foreach ($apps as $app) {
            $a = new GooglePlayApp();

            $a->id = $app[12][0] ?? null;
            $a->packageName = $app[12][0] ?? null;
            $a->name = $app[2] ?? null;
            $a->cover = $app[1][1][0][3][2] ?? null;
            $a->description = $app[4][1][1][1][1] ?? null;
            $a->type = Price::$FREE;
            $a->link = $app[9][4][2] ?? null;
            $a->rating = $app[6][0][2][1][0] ?? null;
            $a->ratingFloat = $app[6][0][2][1][1] ?? null;

            $d = new GooglePlayDeveloper();
            $d->name = $app[4][0][0][0] ?? null;
            $d->link = $app[4][0][0][1][4][2] ?? null;
            $a->developer = $d;

            foreach ($app[1][1] as $image) {
                $i = new GooglePlayImage();
                $i->url = $image[3][2];
                $i->height = $image[2][0] ?? null;
                $i->width = $image[2][1] ?? null;
                $a->images[] = $i;
            }

            if (null !== $app[7] && \count($app[7])) {
                $a->type = Price::$PAID;
                $a->price = $app[7][0][3][2][1][0][0] ?? null;
                $a->priceFormatted = $app[7][0][3][2][1][0][2] ?? null;
                $a->currency = $app[7][0][3][2][1][0][1] ?? null;
                $a->buyLink = $app[7][0][3][2][6][5][2] ?? null;
            }

            $data[] = $a;
        }

        return $data;
    }
}
