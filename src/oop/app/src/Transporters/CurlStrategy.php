<?php

namespace src\oop\app\src\Transporters;

class CurlStrategy implements TransportInterface
{
    public function getContent(string $url): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $content = curl_exec($ch);
        $info = curl_getinfo($ch);
        $charset = end(explode('=', $info['content_type']));
        if ($charset !== 'utf-8') {
            $content = mb_convert_encoding($content, 'UTF-8', 'windows-1251');
        }
        return $content;
    }
}
