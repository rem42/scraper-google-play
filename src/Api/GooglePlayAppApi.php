<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayApp;
use Scraper\ScraperGooglePlay\Entity\GooglePlayCategory;
use Scraper\ScraperGooglePlay\Entity\GooglePlayDeveloper;
use Scraper\ScraperGooglePlay\Entity\GooglePlayMedia;
use Scraper\ScraperGooglePlay\Entity\GooglePlayPegi;
use Scraper\ScraperGooglePlay\Utils\Price;

final class GooglePlayAppApi extends AbstractApi
{
    public function execute(): GooglePlayApp
    {
        /** @var array $content */
        $content = json_decode(substr($this->response->getContent(), 6), false);

        /** @var array $content */
        $content = json_decode($content[0][2], false);

        /** @var array<int, array> $app */
        $app = $content[0];

        $a = new GooglePlayApp();
        $a->name = $app[0][0] ?? null;
        $a->description = $app[10][0][1] ?? null;
        $a->shortDescription = $app[10][1][1] ?? null;
        $a->logo = $app[12][1][3][2] ?? null;
        $a->landscape = $app[12][2][3][2] ?? null;
        $a->releaseDate = $app[12][36] ?? null;
        $a->downloadRange = $app[12][9][0] ?? null;
        $a->download = $app[12][9][2] ?? null;
        $a->changeLog = $app[12][6][1] ?? null;
        $a->privacyPolicyUrl = $app[12][7][2] ?? null;
        $a->type = 1 === $app[12][11][0]
            ? Price::$FREE
            : Price::$PAID
        ;
        $a->firstReleaseDate = $app[12][36] ?? null;

        foreach ($app[12][0] as $img) {
            $i = new GooglePlayMedia();
            $i->url = $img[3][2] ?? null;
            $a->images[] = $i;
        }

        if (\is_array($app[12][3])) {
            $v = new GooglePlayMedia();
            $v->id = $app[12][3][0][2] ?? null;
            $v->url = $app[12][3][0][3][2] ?? null;
            $v->metadata = $app[12][3][0][4] ?? null;
            $a->video = $v;
        }

        if (\is_array($app[12][4])) {
            $p = new GooglePlayPegi();
            $p->name = $app[12][4][0] ?? null;
            $m = new GooglePlayMedia();
            $m->id = $app[12][4][1][1] ?? null;
            $m->url = $app[12][4][1][3][2] ?? null;
            $p->media = $m;
            $a->pegi = $p;
        }

        if (\is_array($app[12][5])) {
            $d = new GooglePlayDeveloper();
            $d->name = $app[12][5][1] ?? null;
            $d->mail = $app[12][5][2][0] ?? null;
            $d->website = $app[12][5][3][5][2] ?? null;
            $d->address = $app[12][5][4][0] ?? null;
            $d->link = $app[12][5][5][4][2] ?? null;
            $a->developer = $d;
        }

        if (\is_array($app[12][13])) {
            $c = new GooglePlayCategory();
            $c->name = $app[12][13][0][0] ?? null;
            $c->code = $app[12][13][0][2] ?? null;
            $a->category = $c;
        }
        return $a;
    }
}
