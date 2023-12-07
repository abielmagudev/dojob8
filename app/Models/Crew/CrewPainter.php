<?php 

namespace App\Models\Crew;

class CrewPainter
{
    const COLOR_HEX_PATTERN = '/^#[0-9A-Fa-f]{6}$/';

    const BACKGROUND_COLOR_DEFAULT = '#FFFFFF';

    const TEXT_COLOR_MODE_DEFAULT = 'dark';
    
    public static $text_color_modes_colors = [
        'dark' => '#333333',
        'light' => '#F5F5F5',
    ];

    public static function getTextColorModesAndColors()
    {
        return self::$text_color_modes_colors;
    }

    public static function getTextColorModes()
    {
        return array_keys( self::$text_color_modes_colors );
    }

    public static function existsTextColorMode(string $mode)
    {
        return array_key_exists($mode, self::$text_color_modes_colors);
    }

    public static function getTextColorByMode(string $mode)
    {
        return self::$text_color_modes_colors[$mode] ?? null;
    }
}
