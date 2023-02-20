<?php


namespace App\Formatters;


class Htmlspecialchars implements FormatterInterface
{
    /**
     * @param string $text
     * @return string
     */
    public function format(string $text): string
    {
        return htmlspecialchars($text);
    }
}