<?php

class Log
{
    public static function i($msg)
    {
        self::write('I', $msg);
    }

    public static function e($msg)
    {
        self::write('E', $msg);
    }

    private static function write($level, $msg)
    {
        $filename = DIR_ROOT . "/logs/corp.log";
        $logFile = fopen($filename, "aw");
        fwrite($logFile, $level . "/" . date(" Y-m-d H:i:s") . "=====" . $msg . "\n");
        fclose($logFile);
    }

}
