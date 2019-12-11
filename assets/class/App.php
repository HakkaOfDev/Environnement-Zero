<?php

/**
 * Class App
 *
 * This class is a factory, it allows to manage all the other classes by getters or setters
 */

class App
{

    static $db = null;

    /**
     *
     * Getter of Database (MySQL)
     *
     * @return Database|null
     */

    static function getDatabase()
    {
        if (!self::$db) {
            self::$db = new Database('root', '', 'zero');
        }
        return self::$db;
    }

    /**
     * Getter of Auth
     *
     * @return Auth
     */

    static function getAuth()
    {
        return new Auth(Session::getInstance());
    }

    /**
     * Redirecting function
     *
     * @param $direction
     */

    static function redirect($direction)
    {
        header("Location: $direction");
        exit();
    }

}