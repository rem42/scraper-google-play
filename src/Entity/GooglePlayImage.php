<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

/**
 * Class GooglePlayImage
 */
final class GooglePlayImage
{
    private string $url;

    private int $width;

    private int $height;

    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return $this
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return $this
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }
}
