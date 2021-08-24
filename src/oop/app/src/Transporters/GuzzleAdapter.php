<?php

namespace src\oop\app\src\Transporters;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Header;

class GuzzleAdapter implements TransportInterface
{
    public function getContent(string $url): string
    {
        $client = new Client();
        $response = $client->get($url);
        $content = $response->getBody()->getContents();
        $contentType = $response->getHeader('content-type');
        $headers = Header::parse($contentType);
        if (isset($headers[0]['charset']) && $headers[0]['charset'] !== 'utf-8') {
            $content = mb_convert_encoding($content, 'UTF-8', $headers[0]['charset']);
        }
        return $content;
    }
}
