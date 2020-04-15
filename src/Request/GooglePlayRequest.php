<?php

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Annotation\Scraper;
use Scraper\Scraper\Request\ScraperRequest;

/**
 * @Scraper(host="play.google.com/", scheme="HTTPS")
 */
abstract class GooglePlayRequest extends ScraperRequest
{
}
