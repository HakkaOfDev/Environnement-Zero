<?php

/**
 * Class StringUtils
 */
class StringUtils
{
    /**
     * Generate a string with a specific length.
     *
     * @param $length
     * @return false|string
     * */
    static function random($length)
    {
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }
}