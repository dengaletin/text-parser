<?php

namespace App;


use App\Exceptions\ContainerException;
use App\Exceptions\InputValidationException;
use App\Formatters\FormatterInterface;
use App\Models\InputReader;
use ReflectionException;

class Facade
{
    /** @var InputReader */
    private $inputReader;
    /** @var Container */
    private $container;

    /**
     * Editor constructor.
     * @param InputReader $inputReader
     * @param Container $container
     */
    public function __construct(InputReader $inputReader, Container $container)
    {
        $this->inputReader = $inputReader;
        $this->container = $container;
    }

    /**
     * @param string $request
     * @return string
     */
    public function response(string $request): string
    {
        try {
            $inputData = $this->inputReader->handle($request);
        } catch (InputValidationException $e) {
            return json_encode(['error' => $e]);
        }

        $text = $inputData->text();
        foreach ($inputData->methods() as $formatterName) {
            /** @var FormatterInterface $formatter */
            try{
                $formatter = $this->container->get('App\\Formatters\\' . ucfirst($formatterName));
            } catch (ContainerException $e) { // тут желательна запись в лог
                return json_encode(['error' => 'service not working']);
            } catch (ReflectionException $e) { // тут желательна запись в лог
                return json_encode(['error' => 'service not working']);
            }

            $text = $formatter->format($text);
        }
        return json_encode(['text' => $text]);
    }
}