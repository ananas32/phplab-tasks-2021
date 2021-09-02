<?php

namespace src\oop\app\src\Parsers;

class FilmixParserStrategy implements ParserInterface
{
    public function parseContent(string $siteContent): array
    {
        preg_match_all('|<h[^>]+>(.*)</h1>|', $siteContent, $matches);;
        $title = $matches[0][0];
        preg_match_all('|<img src="([^"]*)" (.*[\s+\"\']poster poster-tooltip[\s + \"\'].*)|', $siteContent, $matches);
        $poster = $matches[1][0];
        preg_match_all('|<div class="full-story">(.*)<\/div><div|', $siteContent, $matches);
        $description = strip_tags($matches[0][0]);

        return [
            'title' => $title,
            'description' => $description,
            'poster' => $poster
        ];
    }
}
