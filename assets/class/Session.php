<?php

/**
 * Class Session
 *
 * This class is the main class of Session management.
 */
class Session
{

    static $instance;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Getter of Session instance (get class)
     *
     * @return Session
     */
    static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Session();
        }
        return self::$instance;
    }

    /**
     * Send a flash message.
     *
     * @param $key
     * @param $message
     */
    public function sendFlash($key, $message)
    {
        $_SESSION['flash'][$key] = $message;
    }

    /**
     * Check if any flashes messages exists.
     *
     * @return bool
     */
    public function hasFlashed()
    {
        return isset($_SESSION['flash']);
    }

    /**
     * Return array of flashes messages.
     *
     * @return mixed
     */
    public function getFlashes()
    {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    /**
     * This function write a value in a session key.
     *
     * @param $key
     * @param $value
     */
    public function write($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * This funciton return a session value from a variable key.
     *
     * @param $key
     * @return mixed|null
     */
    public function read($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * This function delete a session key.
     *
     * @param $key
     */
    public function delete($key)
    {
        unset($_SESSION[$key]);
    }
}