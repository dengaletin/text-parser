<?php


namespace App\Formatters;


class StripTags implements FormatterInterface
{
    /**
     * @param string $text
     * @return string
     */
    public function format(string $text): string
    {
        return strip_tags($text);
    }
}