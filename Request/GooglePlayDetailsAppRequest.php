<?php

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Annotation\UrlAnnotation;

/**
 * Class GooglePlayDetailsAppRequest
 * @package Scraper\ScraperGooglePlay\Request\GooglePlay
 *
 * @UrlAnnotation(url="store/xhr/getdoc?authuser=0", method="POST", contentType="Scraper\ScraperGooglePlay\Mediator\GooglePlayMediator", protocol="HTTP")
 */
class GooglePlayDetailsAppRequest extends GooglePlayRequest
{
	/**
	 * @var string
	 */
	protected $id;
	
	protected $xhr = 1;

	/**
	 * @return array
	 */
	public function getBody(){
		return [
			'ids' => $this->id,
			'xhr' => $this->xhr,
		];
	}
	
	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @param string $id
	 *
	 * @return $this
	 */
	public function setId($id)
	{
		$this->id = $id;
		
		return $this;
	}
}
