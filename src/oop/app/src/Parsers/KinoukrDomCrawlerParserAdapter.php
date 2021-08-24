<?php

namespace src\oop\app\src\Parsers;

use src\oop\app\src\Models\Movie;
use Symfony\Component\DomCrawler\Crawler;

class KinoukrDomCrawlerParserAdapter implements ParserInterface
{
    public function parseContent(string $siteContent)
    {
        $crawler = new Crawler($siteContent);
        $title = $crawler->filter('h1')->html();
        $poster = $crawler->filter('.fposter a')->eq(0)->attr('href');
        $content = $crawler->filter('.full-text ');
        $description = str_replace($crawler->filter('h2')->text(), '', $content->text());

        return new Movie($title, $description, $poster);
    }
}
