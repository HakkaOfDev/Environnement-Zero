<?php

/**
 * Class Auth
 *
 * This class allows to manage the authentication from student.
 */

class Auth
{
    private $session;
    private $options = [
        'restriction_msg' => "Vous n'avez pas le droit d'accéder à cette page"
    ];

    /**
     * Auth constructor.
     *
     * @param $session
     * @param array $options
     */
    public function __construct($session, $options = [])
    {
        $this->options = array_merge($this->options, $options);
        $this->session = $session;
    }

    /**
     * This function return a Student.class from the database with his name.
     *
     * @param string $name
     */
    public function getUser($db, $name){
        $query = $db->query('SELECT * FROM students WHERE name = ?', [$name]);
        $targetUser = $query->fetch();
        if($targetUser){
            return $targetUser;
        }
        return null;
    }

    /**
     * This function return a Student.class from the database with his id.
     *
     * @param int $id
     */
    public function getUserById($db, $id){
        $query = $db->query('SELECT * FROM students WHERE id = ?', [$id]);
        $student = $query->fetch();
        if($student){
            return $student;
        }
    }

    /**
     * This function register the new student.
     *
     * @param $db
     * @param $name
     * @param $firstname
     * @param $email
     * @param $password
     */

    public function register($db, $name, $firstname, $email, $password, $status, $grade)
    {
        $bpassword = password_hash($password, PASSWORD_BCRYPT);
        $db->query('INSERT INTO students (email, password, name, firstname, avatar, status, grade) VALUES (?,?,?,?,?,?,?)', [$email, $bpassword, $name, $firstname, 'default.jpg', $status, $grade]);
    }

    /**
     * This function check if the student is logged and restrict different pages of website (example: profil.php)
     */
    public function restrict()
    {
        if (!$this->session->read('auth')) {
            $this->session->sendFlash('danger', $this->options['restriction_msg']);
            header('Location: login.php');
            exit();
        }
    }

    /**
     * This function reconnect the student from a cookie if the student checked the "remember me" box.
     *
     * @param $db
     */
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

    /**
     * This funciton return $_SESSSION of student or if it does not exist, false.
     *
     * @return bool
     */
    public function getStudent()
    {
        if (!$this->session->read('auth')) {
            return false;
        }
        return $this->session->read('auth');
    }

    /**
     * She puts the $student variable in the $_SESSION['auth'] (variable de connection)
     *
     * @param $student
     */
    public function connect($student)
    {
        $this->session->write('auth', $student);
    }

    /**
     * This function logs the student.
     *
     * @param $db
     * @param $email
     * @param $password
     * @param bool $remember
     * @return bool
     */
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

    /**
     * This function logout the student by removing the $_SESSION['auth']
     */
    public function logout()
    {
        setcookie('remember', NULL, -1);
        $this->session->delete('auth');
    }

    /**
     * Return the Session class
     *
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }
}
