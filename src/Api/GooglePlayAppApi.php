<?php

declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayApp;
use Scraper\ScraperGooglePlay\Entity\Shared\Category;
use Scraper\ScraperGooglePlay\Entity\Shared\Developer;
use Scraper\ScraperGooglePlay\Entity\Shared\Image;
use Scraper\ScraperGooglePlay\Entity\Shared\Media;
use Scraper\ScraperGooglePlay\Entity\Shared\Offer;
use Scraper\ScraperGooglePlay\Entity\Shared\Pegi;
use Scraper\ScraperGooglePlay\Entity\Shared\Permission;
use Scraper\ScraperGooglePlay\Entity\Shared\Rating;
use Scraper\ScraperGooglePlay\Entity\Shared\RatingDistribution;
use Scraper\ScraperGooglePlay\Utils\ScriptData;

final class GooglePlayAppApi extends AbstractApi
{
    public function execute(): GooglePlayApp
    {
        $content = ScriptData::extract($this->response->getContent(), 'ds:5');

        /** @var array<int, array<mixed>> $app */
        $app = $content[1][2];

        $a = new GooglePlayApp();
        $a->id = $app[77][0] ?? null;
        $a->name = $app[0][0] ?? null;
        $a->packageName = $app[77][0] ?? null;
        // The translated description, when Google provides one, comes before the original.
        $a->description = $app[12][0][0][1] ?? $app[72][0][1] ?? null;
        $a->shortDescription = $app[73][0][1] ?? null;
        $a->purchaseInApp = $app[19][0] ?? null;
        $a->latestVersion = $this->block($app, 140)[0][0][0] ?? null;
        $a->androidVersion = $this->block($app, 140)[1][1][0][0][1] ?? null;

        $a->changeLog = $this->block($app, 144)[1][1] ?? null;
        $a->privacyPolicyUrl = $app[99][0][5][2] ?? null;

        $a->downloadRange = $app[13][0] ?? null;
        $a->downloadMin = $app[13][1] ?? null;
        $a->download = $app[13][2] ?? null;

        $a->adSupported = (bool) ($app[48] ?? false);
        $a->preregister = 1 === ($app[18][0] ?? null);
        $a->playPass = (bool) ($app[62] ?? false);

        if (\is_array($app[9])) {
            $p = new Pegi();
            $p->name = $app[9][0] ?? null;
            $p->description = $this->decode($app[9][2][1] ?? null);
            $p->interactiveElements = $this->decode($app[9][3][1] ?? null);
            $m = new Image();
            $m->url = $app[9][1][3][2] ?? null;
            $m->width = $app[9][1][2][1] ?? null;
            $m->height = $app[9][1][2][0] ?? null;
            $p->media = $m;
            $a->pegi = $p;
        }

        if (isset($app[10][1][0])) {
            $dateTime = new \DateTime();
            $dateTime->setTimestamp($app[10][1][0]);
            $a->firstReleaseDate = $dateTime;
        }

        if (isset($app[51][0][0])) {
            $rating = new Rating();
            $rating->note = $app[51][0][0] ?? null;
            $rating->noteFloat = $app[51][0][1] ?? null;
            $rating->count = $app[51][2][1] ?? null;
            $rating->reviewCount = $app[51][3][1] ?? null;

            foreach ($app[51][1] ?? [] as $key => $value) {
                if (null === $value) {
                    continue;
                }
                $ratingDistribution = new RatingDistribution();
                $ratingDistribution->value = $key;
                $ratingDistribution->count = $value[1];
                $rating->distribution[] = $ratingDistribution;
            }
            $a->rating = $rating;
        }

        $offer = new Offer();
        $offer->price = $app[57][0][0][0][0][1][0][0] ?? null;

        if ($offer->price > 0) {
            $offer->type = Offer::$PAID;
            $offer->priceFormatted = $app[57][0][0][0][0][1][0][2] ?? null;
            $offer->currency = $app[57][0][0][0][0][1][0][1] ?? null;
            $offer->buyLink = $app[57][0][0][0][0][6][5][2] ?? null;
            // Filled only during a discount.
            $offer->originalPrice = $app[57][0][0][0][0][1][1][0] ?? null;
        }
        $a->offer = $offer;

        if (\is_array($app[69])) {
            $d = new Developer();
            $d->name = $app[68][0] ?? null;
            $d->link = $app[68][1][4][2] ?? null;
            $d->id = $this->extractDeveloperId($d->link);
            $d->mail = $app[69][1][0] ?? null;
            $d->website = $app[69][0][5][2] ?? null;
            $d->address = $app[69][2][0] ?? null;
            $d->phone = $app[69][4][3] ?? null;
            $d->legalName = $app[69][4][0] ?? null;
            $d->legalMail = $app[69][4][1][0] ?? null;
            $d->legalAddress = isset($app[69][4][2][0]) ? str_replace("\n", ', ', $app[69][4][2][0]) : null;
            $a->developer = $d;
        }

        if (isset($app[74][2][0])) {
            foreach ($app[74][2][0] as $item) {
                $p = new Permission();
                $p->name = $item[0] ?? null;
                $p->icon = $item[1][3][2] ?? null;
                $p->code = $item[3][0] ?? null;

                if (isset($item[2])) {
                    foreach ($item[2] as $value) {
                        $p->list[] = $value[1] ?? null;
                    }
                }
                $a->permissions[] = $p;
            }
        }

        foreach ($app[78][0] ?? [] as $img) {
            $i = new Image();
            $i->url = $img[3][2] ?? null;
            $i->width = $img[2][1] ?? null;
            $i->height = $img[2][0] ?? null;
            $a->images[] = $i;
        }

        if (isset($app[79][0][0][0])) {
            $c = new Category();
            $c->name = $app[79][0][0][0] ?? null;
            $c->code = $app[79][0][0][2] ?? null;
            $a->category = $c;
        }

        $this->extractCategories($app[118] ?? null, $a->categories);

        if ([] === $a->categories && null !== $a->category?->name) {
            $a->categories[] = $a->category->name;
        }

        if (isset($app[95][0][3][2])) {
            $image = new Image();
            $image->url = $app[95][0][3][2];
            $image->height = $app[95][0][2][0] ?? null;
            $image->width = $app[95][0][2][1] ?? null;
            $a->cover = $image;
        }

        if (isset($app[96][0][3][2])) {
            $image = new Image();
            $image->url = $app[96][0][3][2];
            $image->height = $app[96][0][2][0] ?? null;
            $image->width = $app[96][0][2][1] ?? null;
            $a->headerImage = $image;
        }

        if (isset($app[100][0][0]) && \is_array($app[100][0][0])) {
            $v = new Media();
            $v->id = $app[100][0][0][2] ?? null;
            $v->url = $app[100][0][0][3][2] ?? null;
            $v->metadata = $app[100][0][0][4] ?? null;
            $v->previewUrl = $app[100][1][2][0][2] ?? null;

            if (isset($app[100][1][0][3][2])) {
                $thumbnail = new Image();
                $thumbnail->url = $app[100][1][0][3][2];
                $thumbnail->height = $app[100][1][0][2][0] ?? null;
                $thumbnail->width = $app[100][1][0][2][1] ?? null;
                $v->thumbnail = $thumbnail;
            }
            $a->video = $v;
        }

        $updatedAt = $this->block($app, 145)[0][1][0] ?? null;

        if (null !== $updatedAt) {
            $dateTime = new \DateTime();
            $dateTime->setTimestamp($updatedAt);
            $a->releaseDate = $dateTime;
        }

        return $a;
    }

    /**
     * Some pages move the blocks from index 140 into a trailing object keyed by their index + 1 ("141" for 140).
     *
     * @param array<mixed> $app
     */
    private function block(array $app, int $index): mixed
    {
        if (isset($app[$index])) {
            return $app[$index];
        }

        $tail = end($app);

        return \is_array($tail) ? $tail[$index + 1] ?? null : null;
    }

    /**
     * Collects the category names: a category is a list starting with its name, the nested lists group them.
     *
     * @param array<int, string> $categories
     */
    private function extractCategories(mixed $data, array &$categories): void
    {
        if (!\is_array($data) || [] === $data) {
            return;
        }

        if (\count($data) >= 4 && \is_string($data[0] ?? null)) {
            $categories[] = $data[0];

            return;
        }

        foreach ($data as $item) {
            $this->extractCategories($item, $categories);
        }
    }

    private function extractDeveloperId(?string $link): ?string
    {
        if (null === $link) {
            return null;
        }

        parse_str((string) parse_url($link, \PHP_URL_QUERY), $query);

        return \is_string($query['id'] ?? null) ? $query['id'] : null;
    }

    private function decode(?string $text): ?string
    {
        return null !== $text ? html_entity_decode($text, \ENT_QUOTES | \ENT_HTML5) : null;
    }
}
