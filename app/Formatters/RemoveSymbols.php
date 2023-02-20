<?php


namespace App\Formatters;


class RemoveSymbols implements FormatterInterface
{
    /**
     * @param string $text
     * @return string
     */
    public function format(string $text): string
    {
        return preg_replace('/[.,\/!@#$%^&*()]+/', '', $text);
    }
}