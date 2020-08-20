<?php
class User
{
    private $pdo;

    public $id;
    public $name;
    public $email;
    public $password;
    public $level;
    public $active;
    public $lastAccess;
    public $session;
    public $avatar;
    public $timeStamp;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::startUp();
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function index()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM users ORDER BY name");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }

    }

    public function delete($id) {
        try {
            $stm = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
            $stm->execute(array($id));
            return true;
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function create($name, $email, $level) {
        try {
            $stm = $this->pdo->prepare("INSERT INTO users (name, email, level) VALUES(?, ?, ?)");
            $stm->execute(array($name, $email, $level));
            return $this->pdo->lastInsertId();
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }

    }

    public function view($id) {
        $stm = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stm->execute(array($id));
        return $stm->fetch(PDO::FETCH_OBJ);
    }

    public function update($name, $email, $level, $id) {
        try {
            $stm = $this->pdo->prepare("UPDATE users SET name = ?, email = ?, level = ? WHERE id = ?");
            $stm->execute(array($name, $email, $level, $id));
            return true;
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }

    }

    public function validate($email, $password) {
        $stm = $this->pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ? ");
        $stm->execute(array($email, $password));
        if ($stm->rowCount() > 0) {
            return $stm->fetch(PDO::FETCH_OBJ);
        } else
        {
            return false;
        }
    }

    public function lastAccess($id) {
        $dateTime  = date('Y-m-d h:i:s');
        $stm = $this->pdo->prepare("UPDATE users SET lastAccess = ? WHERE id = ?");
        $stm->execute(array($dateTime, $id));
    }

}