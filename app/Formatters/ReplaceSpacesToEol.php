<?php


namespace App\Formatters;


class ReplaceSpacesToEol implements FormatterInterface
{
    /**
     * @param string $text
     * @return string
     */
    public function format(string $text): string
    {
        return str_replace(' ', PHP_EOL, $text);
    }
}