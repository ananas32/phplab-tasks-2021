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
        $array = explode(' ', $input);
        foreach ($array as $key => $item) {
            preg_match_all('/./us', $item, $ar);
            $array[$key] = implode(array_reverse($ar[0]));
        }
        return implode(' ', $array);
    }

    /**
     * @param string $noun
     * @return string
     */
    public function getBrandName(string $noun): string
    {
        if ($noun[0] === substr($noun, -1)) {
            return ucfirst($noun) . substr($noun, 1);
        }
        return 'The ' . ucfirst($noun);
    }
}
