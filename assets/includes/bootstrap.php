<?php

spl_autoload_register('my_autoloader');

function my_autoloader($class){
    require "assets/class/$class.php";
}