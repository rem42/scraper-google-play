<?php

declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Attribute\Method;
use Scraper\Scraper\Attribute\Scheme;
use Scraper\Scraper\Attribute\Scraper;
use Scraper\Scraper\Request\ScraperRequest;

#[Scraper(method: Method::POST, scheme: Scheme::HTTPS, host: 'play.google.com', path: '_/PlayStoreUi/data/batchexecute')]
abstract class GooglePlayRequest extends ScraperRequest
{
    protected ?string $country = null;

    /**
     * Store country ("gl"), e.g. "fr": it drives prices, currency and availability.
     */
    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return array<string, string>
     */
    protected function getCountryQuery(): array
    {
        return null !== $this->country ? ['gl' => $this->country] : [];
    }
}
