<?php

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayApplication;
use Scraper\ScraperGooglePlay\Entity\GooglePlayImage;
use Scraper\ScraperGooglePlay\Entity\GooglePlayMedia;
use Scraper\ScraperGooglePlay\Entity\GooglePlayPermissions;

class GooglePlayDetailsApplicationApi extends AbstractApi
{
    public function execute()
    {
        $content = $this->response->getContent();

        $content = json_decode(substr($content, 6));

        foreach ($content as $item) {
            switch ($item[1]) {
                case 'jLZZ2e':
                    $app = json_decode($item[2])[0];
                    dump($app);
                    $a                   = new GooglePlayApplication();
                    $a->name             = $app[0][0];
                    $a->description      = $app[10][0][1];
                    $a->shortDescription = $app[10][1][1];
                    $a->cover            = $app[12][1][3][2];
                    $a->landscape        = $app[12][2][3][2];

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
                    dump($a);
                    break;
            }
        }

        //dump($content);
        die('');

        $data         = $this->data[0][2][0];
        $this->object = new GooglePlayApplication();
        $this->object
            ->setId($this->request->getId())
            ->setLink($data[6])
            ->setName($data[8])
            ->setCover($data[18])
            ->setPrice($data[13][0][1])
            ->setShortDescription($data[57])
            ->setDescription($data[9])
            ->setRating($data[16])
            ->setRatingCount($data[17])
            ->setCategory($data[14][0][0])
            ->setDeveloper($data[65]->{42656262}[0][0])
        ;

        $meta = $data[65]->{42656262};
        $this->object
            ->setLastUpdated($meta[2])
            ->setInstalls($meta[5] . ' - ' . $meta[6])
            ->setCurrentVersion($meta[7])
            ->setRequireAndroidVersion($meta[9])
            ->setContentRating([
                $meta[21][0],
                $meta[21][1],
            ])
            ->setPrice($meta[20])
        ;

        if (isset($meta[21][4])) {
            $this->object
                ->setInteractiveElements($meta[21][4])
            ;
        }

        for ($i=0; $i < 2; $i++) {
            for ($j=0; $j < sizeof($meta[23][$i]); $j++) {
                for ($k=0; $k < sizeof($meta[23][$i][$j][1]); $k++) {
                    $perm = new GooglePlayPermissions();
                    $perm
                        ->setTitle($meta[23][$i][$j][1][$k][0])
                        ->setDescription($meta[23][$i][$j][1][$k][1])
                    ;
                    $this->object->addPermissions($perm);
                }
            }
        }

        if (isset($meta[23][2])) {
            for ($i=0; $i < sizeof($meta[23][2]); $i++) {
                $perm = new GooglePlayPermissions();
                $perm
                    ->setTitle($meta[23][2][$i][0])
                    ->setDescription($meta[23][2][$i][1])
                ;
                $this->object->addPermissions($perm);
            }
        }

        if (isset($data[20])) {
            for ($i=0; $i < sizeof($data[20]); $i++) {
                $image = new GooglePlayImage();
                $image
                    ->setUrl($data[20][$i][4])
                    ->setWidth($data[20][$i][1][0])
                    ->setHeight($data[20][$i][1][1])
                ;

                $this->object->addImages($image);
            }
        }

        unset($data);
        unset($meta);

        return $this->object;
    }
}
