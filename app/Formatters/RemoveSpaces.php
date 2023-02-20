<?php

namespace App\Formatters;

class RemoveSpaces implements FormatterInterface
{
    /**
     * @param string $text
     * @return string
     */
    public function format(string $text): string
    {
        return str_replace(' ', '', $text);
    }
}