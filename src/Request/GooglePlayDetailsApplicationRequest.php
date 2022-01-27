<?php

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Annotation\Scraper;
use Scraper\Scraper\Request\RequestBody;
use Scraper\Scraper\Request\RequestQuery;

/**
 * @Scraper(path="_/PlayStoreUi/data/batchexecute", method="POST")
 */
final class GooglePlayDetailsApplicationRequest extends GooglePlayRequest implements RequestQuery, RequestBody
{
    protected string $id;
    protected string $language = 'en';

    /**
     * @return string[]
     */
    public function getQuery(): array
    {
        return [
            'hl' => $this->language,
        ];
    }

    /**
     * @return string[]
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
