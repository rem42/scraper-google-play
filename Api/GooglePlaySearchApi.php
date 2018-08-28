<?php

namespace Scraper\ScraperGooglePlay\Api;

use Doctrine\Common\Collections\ArrayCollection;
use Scraper\ScraperGooglePlay\Entity\GooglePlayAppSearch;
use Scraper\ScraperGooglePlay\Request\GooglePlaySearchRequest;
use Symfony\Component\DomCrawler\Crawler;

class GooglePlaySearchApi extends GooglePlayApi
{
	/**
	 * @var GooglePlaySearchRequest
	 */
	protected $request;

	/**
	 * @return ArrayCollection|mixed
	 */
	public function execute()
	{
		$this->object = new ArrayCollection();
		$this->data->filter('.id-card-list div.card')->each(function(Crawler $node, $i){
			switch ($this->request->getCategory()){
				case 'apps':
					$object = new GooglePlayAppSearch();
					$object
						->setId($node->attr('data-docid'))
						->setLink($node->filter('a.card-click-target')->attr('href'))
						->setCover($node->filter('img')->attr('data-cover-large'))
						->setName(trim($node->filter('.details a.title')->text()))
						->setDeveloper($node->filter('.details a.subtitle')->text())
						->setDescription(trim($node->filter('.details .description')->text()))
						->setPrice(trim($node->filter('.stars-container .price-container')->text()))
					;
					if(!empty($node->filter('.stars-container .tiny-star')->count() > 0)){
						$object
							->setRating(preg_replace("/[^0-9,]/","", $node->filter('.stars-container .tiny-star')->attr('aria-label')))
						;
					}
					$this->object->add($object);
					break;
			}
		});
		return $this->object;
	}
}
