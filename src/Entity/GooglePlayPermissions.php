<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

/**
 * Class GooglePlayPermissions
 */
final class GooglePlayPermissions
{
    private string $title;

    private string $description;

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
