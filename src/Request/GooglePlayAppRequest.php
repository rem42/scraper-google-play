<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Request\RequestBody;
use Scraper\Scraper\Request\RequestQuery;

final class GooglePlayAppRequest extends GooglePlayRequest implements RequestQuery, RequestBody
{
    protected string $id;
    protected string $language;

    public function getQuery(): array
    {
        return [
            'hl' => $this->language,
        ];
    }

    /**
     * @return array<string, string>
     */
    public function getBody(): array
    {
        return [
            'f.req' => '[[["jLZZ2e","[[\"' . $this->id . '\",7],2]"]]]',
        ];
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
