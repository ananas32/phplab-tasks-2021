<?php

namespace strings;

class Strings implements StringsInterface
{
    /**
     * @param string $input
     * @return string
     */
    public function snakeCaseToCamelCase(string $input): string
    {
        return lcfirst(str_replace('_', '', ucwords($input, '_')));
    }

    /**
     * @param string $input
     * @return string
     */
    public function mirrorMultibyteString(string $input): string
    {
        return implode(' ', array_map(function ($item) {
            return implode('', array_reverse(preg_split('//u', $item)));
        }, preg_split('/\s+/', $input)));
    }

    /**
     * @param string $noun
     * @return string
     */
    public function getBrandName(string $noun): string
    {
        return ($noun[0] === $noun[strlen($noun) - 1])
            ? ucfirst($noun) . substr($noun, 1)
            : 'The ' . ucfirst($noun);
    }
}
