<?php

namespace src\oop\app\src\Parsers;

use Symfony\Component\DomCrawler\Crawler;

class KinoukrDomCrawlerParserAdapter implements ParserInterface
{
    public function parseContent(string $siteContent): array
    {
        $crawler = new Crawler($siteContent);
        $title = $crawler->filter('h1')->html();
        $poster = $crawler->filter('.fposter a')->eq(0)->attr('href');
        $content = $crawler->filter('.full-text ');
        $description = str_replace($crawler->filter('h2')->text(), '', $content->text());

        return [
            'title' => $title,
            'description' => $description,
            'poster' => $poster
        ];
    }
}
