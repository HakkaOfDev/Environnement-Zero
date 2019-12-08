<?php 

class Validator {

    private $data;
    private $errors = [];

    public function __construct($data){
        $this->data = $data;
    }

    private function getField($field){
        if(!isset($this->data[$field])){
            return null;
        }
        return $this->data[$field];
    }

    public function isRegister($field, $db, $error){
        $record = $db->query('SELECT id FROM students WHERE name = ?', [$this->getField($field)])->fetch();
        if ($record) {
            $this->errors[$field] = $error;
        }
    }

    public function isEmailValidate($field, $error){
        if(!filter_var($this->getField($field), FILTER_VALIDATE_EMAIL)){
            $this->errors[$field] = $error;
        }
    }

    public function isPasswordValidate($field, $error){
        $value = $this->getField($field);
        if (empty($value) || $value != $this->getField($field . "_confirm")) {
            $this->errors[$field] = $error;
        }
    }

    public function isStudentValidate(){
        return empty($this->errors);
    }

    public function getErrors(){
        return $this->errors;
    }

}