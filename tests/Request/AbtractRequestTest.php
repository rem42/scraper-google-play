<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use PHPUnit\Framework\TestCase;
use Scraper\Scraper\Client;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbtractRequestTest extends TestCase
{
    protected function getClient(string $fixture): Client
    {
        $responseInterface = $this->createMock(ResponseInterface::class);
        $responseInterface
            ->method('getStatusCode')->willReturn(200);
        $responseInterface
            ->method('getContent')->willReturn(file_get_contents(__DIR__ . '/../fixtures/' . $fixture))
        ;
        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient
            ->method('request')->willReturn($responseInterface)
        ;
        // $httpClient = new CurlHttpClient();
        return new Client($httpClient);
    }
}
