<?php

declare(strict_types=1);

namespace App\HexCodeConverter;

/**
 * HexConverter class converts hex codes to rgba code
 */
class HexConverter {
    /**
     * Convert to hex code to rgba!
     *
     *  #FFF Hex Code .3 Alpha
     *  #FFF -> rgba(255, 255, 255, .3)
     *
     * @param string $hexCode string
     * @param string|integer $alpha
     *
     * @return string
     * @throws \Exception
     */
    public function hexCodeToRgbA(string $hexCode, $alpha = 1) : string
    {
        $hexCode = ltrim(trim($hexCode), '#');

        if (strlen($hexCode) === 3) {
            $hexCode = $this->convertToLongHexCode($hexCode);
        }
        $this->validateHexCode($hexCode);
        $hexCodes = str_split($hexCode, 2);
        $hexCodes = array_map(function ($item) {
            return hexdec($item);
        }, $hexCodes);
        $hexCodes['alpha'] = (float) $alpha;

        return sprintf("rgb(%s, %s, %s, %s)",
          $hexCodes[0], $hexCodes[1], $hexCodes[2], $hexCodes["alpha"]
        );
    }


    /**
     *
     *  Validate to HexCode
     *
     *  @param string $hexCode
     *  @throws \Exception
     *
     */
    public function validateHexCode(string $hexCode): void
    {
        if (strlen($hexCode) !== 6) {
            throw new \Exception('Hex color must be equal 6.');
        }

        if (!ctype_xdigit($hexCode)) {
            throw new \Exception('Hex Code is not valid code.');
        }
    }

    /**
     *
     *  Convert to Short Hex Code to Long Hex Code
     *  For Example #FFF -> #FFFFFF
     *
     *  @param string $hex
     *  @return string
     */
    public function convertToLongHexCode(string $hex): string
    {
        return $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
    }
}
