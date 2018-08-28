<?php

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Annotation\UrlAnnotation;
use Scraper\Scraper\Api\ApiInterface;
use Scraper\Scraper\Request\Request;

abstract class GooglePlayApi implements ApiInterface
{
	/**
	 * @var Request
	 */
	protected $request;
	/**
	 * @var mixed
	 */
	protected $data;
	/**
	 * @var UrlAnnotation
	 */
	protected $urlAnnotation;
	/**
	 * @var mixed
	 */
	protected $object;

	/**
	 * GooglePlayApi constructor.
	 * @param Request $request
	 * @param $data
	 * @param UrlAnnotation $urlAnnotation
	 */
	public function __construct(Request $request, $data, UrlAnnotation $urlAnnotation)
	{
		$this->request = $request;
		$this->data = $data;
		$this->urlAnnotation = $urlAnnotation;
	}
}
