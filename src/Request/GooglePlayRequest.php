<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Attribute\Method;
use Scraper\Scraper\Attribute\Scheme;
use Scraper\Scraper\Attribute\Scraper;
use Scraper\Scraper\Request\ScraperRequest;

#[Scraper(method: Method::GET, scheme: Scheme::HTTPS, host: 'play.google.com')]
abstract class GooglePlayRequest extends ScraperRequest
{
}
