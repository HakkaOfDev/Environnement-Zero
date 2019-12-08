<?php

class Auth
{

    private $session;
    private $options = [
        'restriction_msg' => "Vous n'avez pas le droit d'accéder à cette page"
    ];

    public function __construct($session, $options = [])
    {
        $this->options = array_merge($this->options, $options);
        $this->session = $session;
    }

    public function register($db, $name, $firstname, $email, $password)
    {
        $bpassword = password_hash($password, PASSWORD_BCRYPT);
        $db->query('INSERT INTO students (email, password, name, firstname) VALUES (?,?,?,?)', [$email, $bpassword, $name, $firstname]);
    }

    public function restrict()
    {
        if (!$this->session->read('auth')) {
            $this->session->sendFlash('danger', $this->options['restriction_msg']);
            header('Location: login.php');
            exit();
        }
    }

    public function getStudent()
    {
        if (!$this->session->read('auth')) {
            return false;
        }
        return $this->session->read('auth');
    }

    public function connect($student)
    {
        $this->session->write('auth', $student);
    }

    public function reconnectFromCookie($db)
    {
        if (isset($_COOKIE['remember']) && !$this->getStudent()) {
            $remember_token = $_COOKIE['remember'];
            $parts = explode('==', $remember_token);
            $student_id = $parts[0];
            $student = $db->query('SELECT * FROM students WHERE id = ?', [$student_id])->fetch();
            if ($student) {
                $expected = $student_id . '==' . $student->remember_token . sha1($student_id . 'ratonlaveurs');
                if ($expected == $remember_token) {
                    $this->connect($student);
                    setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
                    header('Location: index.php');
                } else {
                    setcookie('remember', null, -1);
                }
            } else {
                setcookie('remember', null, -1);
            }
        }
    }

    public function login($db, $email, $password, $remember = false)
    {
        $student = $db->query('SELECT * FROM students WHERE email = ?', [$email])->fetch();
        if (password_verify($password, $student->password)) {
            $this->connect($student);
            if ($remember) {
                $remember_token = StringUtils::random(250);
                $db->query('UPDATE students SET remember_token = ? WHERE id = ?', [$remember_token, $student->id]);
                setcookie('remember', $student->id . '==' . $remember_token . sha1($student->id . 'ratonlaveurs'), time() + 60 * 60 * 24 * 7);
            }
            return $student;
        } else {
            return false;
        }
    }

    public function logout()
    { 
        setcookie('remember', NULL, -1);
        $this->session->delete('auth');
    }

    public function getSession()
    {
        return $this->session;
    }
}
