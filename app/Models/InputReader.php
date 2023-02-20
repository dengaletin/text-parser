<?php


namespace App\Models;

use App\Exceptions\InputValidationException;

class InputReader
{
    /**
     * @param string $input
     * @return InputData
     * @throws InputValidationException
     */
    public function handle(string $input): InputData
    {
        $this->validate($input);
        return new InputData(
            $this->text($input),
            $this->methods($input)
        );
    }

    /**
     * @param string $input
     * @return bool
     * @throws InputValidationException
     */
    private function validate(string $input): bool
    {
        $object = json_decode($input, false);

        if ($object === null) {
            throw new InputValidationException('not valid JSON');
        }
        if (!isset($object->job)) {
            throw new InputValidationException('not valid JSON structure');
        }
        if (!isset($object->job->text)) {
            throw new InputValidationException('not valid JSON structure');
        }
        if (!isset($object->job->methods)) {
            throw new InputValidationException('not valid JSON structure');
        }
        if (empty($object->job->text)) {
            throw new InputValidationException('empty text');
        }
        if (empty($object->job->methods)) {
            throw new InputValidationException('no methods');
        }

        return true;
    }

    /**
     * @param $input
     * @return string
     */
    private function text($input): string
    {
        return json_decode($input, false)->job->text;
    }

    /**
     * @param $input
     * @return array
     */
    private function methods($input): array
    {
        return json_decode($input, false)->job->methods;
    }
}