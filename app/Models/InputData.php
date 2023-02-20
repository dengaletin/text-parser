<?php


namespace App\Models;


class InputData
{
    /**
     * @var string
     */
    private $text;
    /**
     * @var array
     */
    private $methods;

    /**
     * InputData constructor.
     * @param string $text
     * @param array $methods
     */
    public function __construct(string $text, array $methods)
    {
        $this->text = $text;
        $this->methods = $methods;
    }

    /**
     * @return string
     */
    public function text(): string
    {
        return $this->text;
    }

    /**
     * @return array
     */
    public function methods(): array
    {
        return $this->methods;
    }
}