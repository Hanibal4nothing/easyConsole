<?php

namespace EasyConsole;

/**
 * Class to write colorful in console
 *
 * @package EasyConsole
 * @author  Felix Buchheim <hanibal4nothing@gmail.com>
 */
class CmdColor
{
    /**
     * Font Colors
     *
     * @var string
     */
    const FONT_BLACK = '0;30';
    const FONT_GREY = '1;30';
    const FONT_LIGHT_GREY = '0;37';
    const FONT_BLUE = '0;34';
    const FONT_LIGHT_BLUE = '1;34';
    const FONT_GREEN = '0;32';
    const FONT_LIGHT_GREEN = '1;32';
    const FONT_CYAN = '0;36';
    const FONT_LIGHT_CYAN = '1;36';
    const FONT_RED = '0;31';
    const FONT_LIGHT_RED = '1;31';
    const FONT_PURPLE = '0;35';
    const FONT_LIGHT_PURPLE = '1;35';
    const FONT_BROWN = '0;33';
    const FONT_YELLOW = '1;33';
    const FONT_WHITE = '1;37';
    const FONT_UNDERLINED_BLACK = '4;30';
    const FONT_UNDERLINED_RED = '4;31';
    const FONT_UNDERLINED_GREEN = '4;32';
    const FONT_UNDERLINED_YELLOW = '4;33';
    const FONT_UNDERLINED_BLUE = '4;34';
    const FONT_UNDERLINED_PURPLE = '4;35';
    const FONT_UNDERLINED_CYAN = '4;36';
    const FONT_UNDERLINED_WHITE = '4;37';

    /**
     * BackgroundColors
     *
     * @var string
     */
    const BACKGROUND_BLACK = '40';
    const BACKGROUND_RED = '41';
    const BACKGROUND_GREEN = '42';
    const BACKGROUND_YELLOW = '43';
    const BACKGROUND_BLUE = '44';
    const BACKGROUND_MAGENTA = '45';
    const BACKGROUND_CYAN = '46';
    const BACKGROUND_LIGHT_GRAY = '47';

    /**
     * Set the color in console
     *
     * @param string      $sFontColor
     * @param string|null $sBackgroundColor
     *
     * @return $this
     */
    public function set($sFontColor, $sBackgroundColor = null)
    {
        echo "\033[" . $sFontColor . "m";
        if (true === isset($sBackgroundColor)) {
            echo "\033[" . $sBackgroundColor . "m";
        }

        return $this;
    }

    /**
     * Reset the console color
     *
     * @return $this
     */
    public function reset()
    {
        echo "\033[0m";

        return $this;
    }

    /**
     * Echo string with color
     *
     * @param string      $sContent
     * @param string      $sFontColorKey
     * @param string|null $sBackgroundColorKey
     *
     * @return $this
     */
    public function echoString($sContent, $sFontColorKey, $sBackgroundColorKey = null)
    {
        $this->set($sFontColorKey, $sBackgroundColorKey);
        echo $sContent;
        $this->reset();

        return $this;
    }
}