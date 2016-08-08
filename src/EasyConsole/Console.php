<?php

namespace EasyConsole;

/**
 * Main Class to handle console out- and input
 *
 * @author Felix Buchheim <hanibal4nothing@gmail.com>
 */
class Console
{

    /**
     * Script arguments
     *
     * @todo refactor as collection
     * @var array
     */
    protected $arguments = array();

    /**
     * Class to handle colorful output
     *
     * @var CmdColor
     */
    protected $cmdColor;

    /**
     * Console constructor.
     *
     * @param CmdColor|null $oColorCmd
     */
    public function __construct(CmdColor $oColorCmd = null)
    {
        $this->cmdColor = (true === isset($oColorCmd)) ? $oColorCmd : new CmdColor();
        $this->fetchArguments();
    }

    /**
     * Alias to echo some content
     *
     * @param string      $sContent
     * @param null|string $sColor           => @see CmdColor::constants
     * @param null|string $sBackgroundColor => @see CmdColor::constants
     *
     * @return $this
     */
    public function speak($sContent, $sColor = null, $sBackgroundColor = null)
    {
        if (true === isset($sColor)) {
            $this->cmdColor->echoString($sContent, $sColor, $sBackgroundColor);
        } else {
            echo $sContent;
        }

        return $this;
    }

    /**
     * Break line in console
     *
     * @param int $iTimes
     *
     * @return $this
     */
    public function breakLine($iTimes = 1)
    {
        for ($i = 0; $i < $iTimes; $i++) {
            echo PHP_EOL;
        }

        return $this;
    }

    /**
     * Ask for pw (without console output) and return it
     *
     * @param string $sQuestion
     *
     * @deprecated Dont work on every platform
     * @todo       find a better way
     *
     * @return string
     */
    public function askPassword($sQuestion = 'Password?')
    {
        $this->speak($sQuestion)->breakLine();
        system('stty -echo');
        $sPassword = trim(fgets(STDIN));
        system('stty echo');

        return $sPassword;
    }

    /**
     * Ask a the question and return the answer
     *
     * @param string $sQuestion
     *
     * @return string
     */
    public function ask($sQuestion)
    {
        echo $sQuestion . PHP_EOL;

        $rFp      = fopen("php://stdin", "r");
        $sContent = rtrim(fgets($rFp, 1024));
        fclose($rFp);

        return $sContent;
    }

    /**
     * Ask a yesOrNo question and return the answer as bool
     *
     * @param string $sQuestion
     *
     * @return bool
     */
    public function askYesOrNo($sQuestion)
    {
        echo $sQuestion . ' y => yes, n => no' . PHP_EOL;
        $rFp     = fopen("php://stdin", "r");
        $sAnswer = rtrim(fgets($rFp, 1024));
        fclose($rFp);

        if (strtolower($sAnswer) === 'y') {
            $bResult = true;
        } elseif (strtolower($sAnswer) === 'n') {
            $bResult = false;
        } else {
            $this->speak('Invalid input. Please use "y" or "n" as answer')
                ->breakLine();
            $bResult = $this->askYesOrNo($sQuestion);
        }

        return $bResult;
    }

    /**
     * Simple stream, so next output will overwrite this output
     *
     * @param string      $sContent
     * @param string|null $sColor
     * @param string|null $sBackgroundColor
     *
     * @return $this
     */
    public function streamOutput($sContent, $sColor = null, $sBackgroundColor = null)
    {
        if (true === isset($sColor)) {
            $this->cmdColor->echoString("\r" . $sContent, $sColor, $sBackgroundColor);
        } else {
            echo "\r" . $sContent;
        }

        return $this;
    }

    /**
     * The getter function for the property <em>$arguments</em>.
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * The setter function for the property <em>$arguments</em>.
     *
     * @param  array $arguments
     *
     * @return $this Returns the instance of this class.
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * fetch arguments from console
     *
     * @return array
     */
    protected function fetchArguments()
    {
        if (false === empty($_SERVER['argv']) and count($_SERVER['argv']) > 1) {
            $aArguments = $_SERVER['argv'];
            array_shift($aArguments); // unset fileName as Argument
            $this->arguments = $aArguments;
        } else {
            $this->arguments = array();
        }

        return $this->arguments;
    }
}