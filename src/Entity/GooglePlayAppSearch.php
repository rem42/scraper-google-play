<?php

namespace Scraper\ScraperGooglePlay\Entity;

/**
 * Class GooglePlayAppSearch
 */
final class GooglePlayAppSearch extends GooglePlayObject
{
    protected string $developer;

    public function getDeveloper(): string
    {
        return $this->developer;
    }

    /**
     * @return $this
     */
    public function setDeveloper(string $developer): self
    {
        $this->developer = $developer;

        return $this;
    }
}
