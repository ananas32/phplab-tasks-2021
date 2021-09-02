<?php
/**
 * Create Class - Scrapper with method getMovie().
 * getMovie() - should return Movie Class object.
 *
 * Note: Use next namespace for Scrapper Class - "namespace src\oop\app\src;"
 * Note: Dont forget to create variables for TransportInterface and ParserInterface objects.
 * Note: Also you can add your methods if needed.
 */

namespace src\oop\app\src;

use src\oop\app\src\Models\Movie;

class Scrapper
{
    public $transporter;
    public $parser;

    public function __construct($transporter, $parser)
    {
        $this->transporter = $transporter;
        $this->parser = $parser;
    }

    public function getMovie($url)
    {
        return $this->createMovie($this->parser->parseContent($this->transporter->getContent($url)));
    }

    public function createMovie(array $assocArrayMovie)
    {
        extract($assocArrayMovie);
        $movie = new Movie();
        $movie->setTitle($title);
        $movie->setDescription($description);
        $movie->setPoster($poster);
        return $movie;
    }
}
