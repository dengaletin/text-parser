<?php

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class FormatterServiceTest extends TestCase
{
    private $http;

    public function setUp(): void
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'http://textparser/']);
    }

    public function tearDown(): void
    {
        $this->http = null;
    }

    /**
     * @dataProvider additionProvider
     * @param string $text
     * @param array $methods
     * @param string $key
     * @param string $result
     */
    public function testFormatter(string $text, array $methods, string $key, string $result): void
    {
        /** @var Response $response */
        $response = $this->http->post('', [
            'job' => [
                'text' => $text,
                'methods' => $methods
            ]
        ]);
        $body = $response->getBody();
        $this->assertEquals("{\"$key\":\"$result\"}", $body);
    }

    /**
     * @return array
     */
    public function additionProvider(): array
    {
        return [
            'case_1' => [
                'One two three',
                ['removeSpaces'],
                'text',
                'Onetwothree'
            ],
            'case_2' => [
                'Привет, мне на <a href=\"test@test.ru\">test@test.ru</a> пришло приглашение встретиться, попить кофе с <strong>10%</strong> содержанием молока за <i>$5</i>, пойдем вместе!',
                ['stripTags', 'removeSpaces', 'replaceSpacesToEol', 'htmlspecialchars', 'removeSymbols', 'toNumber'],
                'text',
                '10'
            ],
        ];
    }
}