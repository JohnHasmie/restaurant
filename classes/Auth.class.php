<?php

class Auth extends Database {
    private $database; //Save connection Database

    private $error;

    function __construct() {
        $this->database = $this->connect();
        session_start();
    }

    public function register($user)

    {
        try {
            if ($user['password'] !== $user['password_verification']) {
                $this->error = "Password not match!";
                return false;
            }
            // create hash password 
            $hashPasswd = password_hash($user['password'], PASSWORD_DEFAULT);
            //Insert new user to database
            $sql = $this->database->prepare("INSERT INTO users(firstname, lastname, email, password, location) VALUES(:firstname, :lastname, :email, :pass, :loc)");
            $sql->bindParam(":firstname", $user['firstname']);
            $sql->bindParam(":lastname", $user['lastname']);
            $sql->bindParam(":email", $user['email']);
            $sql->bindParam(":pass", $hashPasswd);
            $sql->bindParam(":loc", $user['location']);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            // If error
            if ($e->errorInfo[0] == 23000) {
                //errorInfor[0] erro information sql
                //23000 is code error unique column
                $this->error = "Email already use!";
                return false;
            } else {
                echo $e->getMessage();
                $this->error = $e->getMessage();
                return false;
            }
        }
    }

    public function login($email, $password) {
        try {
            // Get data from database 
            $stmt = $this->database->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $data = $stmt->fetch();

            // If rows count > 0 
            if ($stmt->rowCount() > 0) {
                // If password right
                if (password_verify($password, $data->password)) {
                    $_SESSION['user_session'] = $data->id;
                    return true;
                } else {
                    $this->error = "Email or Password Wrong";
                    return false;
                }
            } else {
                $this->error = "Email or Password Wrong";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function isLoggedIn()
    {
        // is session user already exist
        if (isset($_SESSION['user_session'])) {
            return true;
        }

        return false;
    }

    public function logout()
    {
        // remove session 
        session_destroy();
        // remove user_session 
        unset($_SESSION['user_session']);
        return true;
    }

    public function getLastError()
    {
        return $this->error;
    }
}
