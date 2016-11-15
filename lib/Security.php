<?php

class Security 
{
    private static $seed = 'CUyz9DnfimN2G7qabc1Y';

    public static function encrypt($s)
    {
        $s = $s . self::$seed;
        $tmp = hash('sha512', $s);
        return $tmp;
    }
    
}