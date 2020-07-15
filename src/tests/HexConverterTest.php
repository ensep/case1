<?php

declare(strict_types=1);

namespace AppTest\HexCodeConverter;

use PHPUnit\Framework\TestCase;
use App\HexCodeConverter\HexConverter;

class HexConverterTest extends TestCase
{
    /**
     * @var HexConverter $converter
     */
    private $converter;

    function setUp()
    {
        parent::setUp();
        $this->converter = new HexConverter();
    }

    /**
     * Tests if valid short code converts to long hex code
     */
    public function testShortHexCodeToLongHexCode()
    {
        $this->assertEquals('FFFFFF', $this->converter->convertToLongHexCode('FFF'));
        $this->assertEquals('FF7700', $this->converter->convertToLongHexCode('F70'));
    }


    /**
     * Tests if not valid hex code
     */
    public function testNotValidHexCodeConverters()
    {
        $this->expectException(\Exception::class);
        $this->converter->hexCodeToRgbA('FFFF', 1);
    }


    /**
     * Tests if not valid different hex code
     */
    public function testNotValidHexConverterf()
    {
        $this->expectException(\Exception::class);
        $this->converter->hexCodeToRgbA('FFFFFZ');
    }

    /**
     * Tests if it excepts when uses not valid hex code
     */
    public function testNotValidHexValidation()
    {
        $this->expectException(\Exception::class);
        $this->converter->validateHexCode('FFFFZZ');
    }

    /**
     * Tests if valid hex codes
     */
    public function testHexCanBeConvertedToRgb()
    {
        $this->assertEquals('rgb(255, 255, 255, 0.3)', $this->converter->hexCodeToRgbA('#FFF', '0.3'));
        $this->assertEquals('rgb(255, 255, 255, 1)', $this->converter->hexCodeToRgbA('#FFFFFF', 1));
        $this->assertEquals('rgb(255, 255, 255, 0.5)', $this->converter->hexCodeToRgbA('FFF', '.5'));
        $this->assertEquals('rgb(255, 255, 255, 1)', $this->converter->hexCodeToRgbA('FFFFFF', 1));
    }
}
