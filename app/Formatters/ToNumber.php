<?php


namespace App\Formatters;


class ToNumber implements FormatterInterface
{
    /**
     * @param string $text
     * @return string
     */
    public function format(string $text): string
    {
        return (int)$text;
    }
}