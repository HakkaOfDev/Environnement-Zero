<?php

spl_autoload_register('my_autoloader');
/**
 * This function is the autoloader from another classes.
 *
 * @param $class
 */
function my_autoloader($class)
{
    require "assets/class/$class.php";
}