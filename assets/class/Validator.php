<?php

/**
 * Class Validator
 *
 * This class is a Validator.
 * For each parameter, it will perform various validations.
 */
class Validator
{

    private $data;
    private $errors = [];

    /**
     * Validator constructor.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Check if the student is already in a database.
     *
     * @param $field
     * @param $db
     * @param $error
     */
    public function isRegister($field, $db, $error)
    {
        $record = $db->query('SELECT id FROM students WHERE name = ?', [$this->getField($field)])->fetch();
        if ($record) {
            $this->errors[$field] = $error;
        }
    }

    /**
     * Return the field of $_POST
     *
     * @param $field
     * @return |null
     */
    private function getField($field)
    {
        if (!isset($this->data[$field])) {
            return null;
        }
        return $this->data[$field];
    }

    /**
     * Verify if email is validated.
     *
     * @param $field
     * @param $error
     */
    public function isEmailValidate($field, $error)
    {
        if (!filter_var($this->getField($field), FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = $error;
        }
    }

    /**
     * Verify if password is validated.
     *
     * @param $field
     * @param $error
     */
    public function isPasswordValidate($field, $error)
    {
        $value = $this->getField($field);
        if (empty($value) || $value != $this->getField($field . "_confirm")) {
            $this->errors[$field] = $error;
        }
    }

    /**
     * Check if data is validated (return if error list is empty)
     *
     * @return bool
     */
    public function isStudentValidate()
    {
        return empty($this->errors);
    }

    /**
     * Get list of errors.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

}