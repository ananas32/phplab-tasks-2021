<?php

namespace src\oop\app\src\Parsers;

use src\oop\app\src\Models\Movie;

class FilmixParserStrategy implements ParserInterface
{
    public function parseContent(string $siteContent)
    {
        preg_match_all('|<h[^>]+>(.*)</h1>|', $siteContent, $matches);;
        $title = $matches[0][0];
        preg_match_all('|<img src="([^"]*)" (.*[\s+\"\']poster poster-tooltip[\s + \"\'].*)|', $siteContent, $matches);
        $poster = $matches[1][0];
        preg_match_all('|<div class="full-story">(.*)<\/div><div|', $siteContent, $matches);
        $description = strip_tags($matches[0][0]);

        return new Movie($title, $description, $poster);
    }
}
