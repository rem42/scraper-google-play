<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use Scraper\ScraperGooglePlay\Entity\GooglePlayApp;
use Scraper\ScraperGooglePlay\Request\GooglePlayAppRequest;

/**
 * @internal
 */
final class GooglePlayAppRequestTest extends AbtractRequestTest
{
    public function testGooglePlayAppRequest(): void
    {
        $client = $this->getClient('app.json');

        $request = new GooglePlayAppRequest();
        $request
            ->setLanguage('fr')
            ->setId('com.mgif.stickman.tower')
            ->setId('org.prowl.torque')
        ;

        $result = $client->send($request);

        $this->assertInstanceOf(GooglePlayApp::class, $result);
    }
}
