<?php

declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Attribute\Method;
use Scraper\Scraper\Attribute\Scheme;
use Scraper\Scraper\Attribute\Scraper;
use Scraper\Scraper\Request\RequestQuery;

/**
 * The app details batchexecute RPC (Ws7gDc) now answers with a gateway error, so the app page is fetched instead:
 * its embedded "ds:5" payload carries the same data.
 */
#[Scraper(method: Method::GET, scheme: Scheme::HTTPS, host: 'play.google.com', path: '/store/apps/details')]
final class GooglePlayAppRequest extends GooglePlayRequest implements RequestQuery
{
    protected string $id;
    protected string $language;

    public function getQuery(): array
    {
        return [
            'id' => $this->id,
            'hl' => $this->language,
        ] + $this->getCountryQuery();
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }
}
