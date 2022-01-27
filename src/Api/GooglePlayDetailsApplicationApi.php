<?php

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayApplication;
use Scraper\ScraperGooglePlay\Entity\GooglePlayCategory;
use Scraper\ScraperGooglePlay\Entity\GooglePlayDeveloper;
use Scraper\ScraperGooglePlay\Entity\GooglePlayMedia;

final class GooglePlayDetailsApplicationApi extends AbstractApi
{
    public $data;
    public $object;

    public function execute(): void
    {
        $content = $this->response->getContent();

        $content = json_decode(substr($content, 6));

        foreach ($content as $item) {
            if ('jLZZ2e' == $item[1]) {
                $app = json_decode($item[2])[0];
                dump($app);
                $a                    = new GooglePlayApplication();
                $a->name              = $app[0][0];
                $a->description       = $app[10][0][1];
                $a->shortDescription  = $app[10][1][1];
                $a->cover             = $app[12][1][3][2];
                $a->landscape         = $app[12][2][3][2];
                $a->releaseDate       = $app[12][36];
                $a->downloadRange     = $app[12][9][0];
                $a->download          = $app[12][9][2];

                if (is_array($app[12][5])) {
                    $d               = new GooglePlayDeveloper();
                    $d->name         = $app[12][5][1];
                    $d->mail         = $app[12][5][2][0];
                    $d->website      = $app[12][5][3][5][2];
                    $d->address      = $app[12][5][4][0];
                    $d->link         = $app[12][5][5][4][2];
                    $a->developer    = $d;
                }

                foreach ($app[12][0] as $img) {
                    $i         = new GooglePlayMedia();
                    $i->url    = $img[3][2];
                    $a->imgs[] = $i;
                }

                if (is_array($app[12][3])) {
                    $v           = new GooglePlayMedia();
                    $v->id       = $app[12][3][0][2];
                    $v->url      = $app[12][3][0][3][2];
                    $v->metadata = $app[12][3][0][4];
                    $a->video    = $v;
                }

                if (is_array($app[12][13])) {
                    $c              = new GooglePlayCategory();
                    $c->name        = $app[12][13][0][0];
                    $c->code        = $app[12][13][0][2];
                    $a->category    = $c;
                }
                dump($a);
            }
        }

        //dump($content);
        die('');
    }
}
