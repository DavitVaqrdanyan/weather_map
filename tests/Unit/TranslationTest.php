<?php

namespace Tests\Unit;

use App\Services\WeatherMapService;
use PHPUnit\Framework\TestCase;

class TranslationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public $tr;

    public function setUp(): void
    {
        $this->tr = new WeatherMapService('en','hy');
    }
    public function testExample()
    {
        $text = $this->tr->translate('hi', true);
        $this->assertTrue(is_array($text));
    }
}
