<?php

namespace Templating\Helper;

use Templating\Exception;

/**
 */
class ColorHelper
{

    const PATTERN_HEX_LONG = '/^#?([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})$/i';
    const PATTERN_HEX_SHORT = '/^#?([a-f0-9]{1})([a-f0-9]{1})([a-f0-9]{1})$/i';


    /**
     * Shortcut to darken a color.
     *
     * @see ::modifyLuminance()
     *
     * @param string $hex
     * @param float $pct
     *
     * @return string
     *
     * @throws Exception
     */
    public function darken(string $hex, $pct): string
    {
        $pct = 1 - (float) $pct;

        list ($r, $g, $b) = $this->hexToRgb($hex);

        $r = round($r * $pct);
        $g = round($g * $pct);
        $b = round($b * $pct);

        return $this->rgbToHex($r, $g, $b);
    }

    /**
     * Shortcut to lighten a color.
     *
     * @see ::modifyLuminance()
     *
     * @param string $hex
     * @param float $pct
     *
     * @return string
     */
    public function lighten(string $hex, $pct): string
    {
        $pct = (float) $pct;

        list ($r, $g, $b) = $this->hexToRgb($hex);

        $r = min(255, round($r + 255 * $pct));
        $g = min(255, round($g + 255 * $pct));
        $b = min(255, round($b + 255 * $pct));

        return $this->rgbToHex($r, $g, $b);
    }


    /**
     * @param string $hex
     *
     * @return int[]
     */
    public function hexToRgb(string $hex): array
    {
        preg_match(static::PATTERN_HEX_LONG, $this->normalizeHex($hex), $match);

        $r = (int) hexdec($match[1]);
        $g = (int) hexdec($match[2]);
        $b = (int) hexdec($match[3]);

        $this->assertRgb($r, $g, $b);

        return [$r, $g, $b];
    }

    /**
     * @param int $r
     * @param int $g
     * @param int $b
     *
     * @return string
     */
    public function rgbToHex(int $r, int $g, int $b): string
    {
        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }

    /**
     * @param string $hex
     * @param bool   $uppercase
     *
     * @return string
     */
    public function normalizeHex(string $hex, bool $uppercase = false): string
    {
        if (preg_match(self::PATTERN_HEX_LONG, $hex)) {
            return $uppercase ? strtoupper($hex) : strtolower($hex);
        }

        if (preg_match(self::PATTERN_HEX_SHORT, $hex, $match)) {
            return $uppercase ?
                '#' . strtoupper($match[1] . $match[1] . $match[2] . $match[2] . $match[3] . $match[3]) :
                '#' . strtolower($match[1] . $match[1] . $match[2] . $match[2] . $match[3] . $match[3]);
        }

        throw new Exception(sprintf('Invalid hex color "%s".', $hex));
    }


    /**
     * @param string $color
     *
     * @throws Exception
     */
    private function assertHex(string $color)
    {
        if (! (
            (bool) preg_match(self::PATTERN_HEX_LONG, $color) ||
            (bool) preg_match(self::PATTERN_HEX_SHORT, $color)
        )) {
            throw new Exception(sprintf('Invalid hex color "%s".', $color));
        }
    }

    /**
     * @param int $r
     * @param int $g
     * @param int $b
     *
     * @throws Exception
     */
    private function assertRgb(int $r, int $g, int $b)
    {
        if (0 > $r || $r > 255 ||
            0 > $g || $g > 255 ||
            0 > $b || $b > 255) {
            throw new Exception(sprintf('Invalid RGB color (%d, %d, %d).', $r, $g, $b));
        }
    }

    /**
     * @param int   $r
     * @param int   $g
     * @param int   $b
     * @param float $a
     *
     * @throws Exception
     */
    private function assertRgba(int $r, int $g, int $b, float $a)
    {
        if (0 > $r || $r > 255 ||
            0 > $g || $g > 255 ||
            0 > $b || $b > 255 ||
            0 > $a || $a > 1) {
            throw new Exception(sprintf('Invalid RGB color (%d, %d, %d, %0.2f).', $r, $g, $b, $a));
        }
    }

    /**
     * @param float $pct
     *
     * @throws Exception
     */
    private function assertPct(float $pct)
    {
        if (0 > $pct || $pct > 1) {
            throw new Exception(sprintf('Invalid percentaje %0.2f (should be in [0.0, 1.0] range)', $pct));
        }
    }
}