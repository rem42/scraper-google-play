<?php

namespace Scraper\ScraperGooglePlay\Mediator;

use GuzzleHttp\Psr7\Response;
use Scraper\Scraper\ContentType\Mediator;
use Scraper\Scraper\Mediator\IMediator;

/**
 * Class GooglePlayMediator
 * @package Scraper\ScraperGooglePlay\Mediator
 */
class GooglePlayMediator extends Mediator
{
	/**
	 * @return mixed
	 */
	public function execute()
	{
		$body = $this->response->getBody()->getContents();
		return json_decode(substr($body, 6));
	}
}
