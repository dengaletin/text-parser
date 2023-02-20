<?php

namespace App\Formatters;

interface FormatterInterface
{
    public function format(string $text): string;
}