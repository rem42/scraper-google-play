<?php

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Annotation\UrlAnnotation;
use Scraper\Scraper\Request\Request;

/**
 * Class GooglePlayRequest
 * @package Scraper\ScraperGooglePlay\Request\GooglePlay
 *
 * @UrlAnnotation(baseUrl="https://play.google.com/")
 */
abstract class GooglePlayRequest extends Request
{
	public function getParameters()
	{
		return [];
	}

	public function getBody()
	{
		return [];
	}

	public function getHeaders()
	{
		return [];
	}
}
