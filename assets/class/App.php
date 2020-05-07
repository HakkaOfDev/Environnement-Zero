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
            self::$db = new Database('root', '9qbmxafMGCExCKgEk4pJQ', 'envzero');
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
    * Getter of PrivateMessage
    *
    * @return PrivateMessage
    */

    static function getPrivateMessage()
    {
        return new PrivateMessage();
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