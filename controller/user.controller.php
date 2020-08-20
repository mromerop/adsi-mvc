<?php
require_once 'model/user.php';

class UserController
{
    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new User();
    }

    public function dashboard()
    {

        require_once 'view/header.php';
        require_once 'view/message.php';
        require_once 'view/footer.php';
    }

    public function index()
    {
        $rows = $this->model->index();
        require_once 'view/header.php';
        require_once 'view/message.php';
        require_once  'view/user/index.php';
        require_once 'view/footer.php';
    }

    public function delete() {
        $this->model->delete($_REQUEST['id']);
        $msg = 'Usuario Eliminado Satisfacotiamente!!!';
        $err = 0;
        header('location: index.php?c=user&a=index&m='.$msg.'&e='.$err);
    }

    public function edit() {
        $c      = Database::encryptor('encrypt','user');
        $aEdit  = Database::encryptor('encrypt','edit');
        $aIndex = Database::encryptor('encrypt', 'index');

        if (!isset($_REQUEST['id'])) {
            $select1 = null;
            $select2 = null;
           $id = null;
           $name = null;
           $email = null;
           $level = null;
           $button = 'Crear Usuario';     
        } else {
            $id = $_REQUEST['id'];
            $row = $this->model->view($id);
            $name = $row->name;
            $email = $row->email;
            $level = $row->level;
            if ($level == 1) {
               $select1 = 'selected';
               $select2 = null;
            } else {
                $select2 = 'selected';
                $select1 = null; 
            }
            $button = 'Actualizar Usuario';
        }

        require_once 'view/header.php';
        require_once 'view/message.php';
        require_once  'view/user/edit.php';
        require_once 'view/footer.php';
    }

    public function crud() {
        $id    = $_REQUEST['id'];
        $name  = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $level = $_REQUEST['level'];

        $err = Database::encryptor('encrypt', 0);

        if ($id == null) {
            $lastId = $this->model->create($name, $email, $level);
            mkdir('documents/'.$lastId, 0700);
            $msg = Database::encryptor('encrypt', 'Usuario Creado Satisfacotiamente!!!');
        } else {
            $this->model->update($name, $email, $level, $id);
            $msg = Database::encryptor('encrypt', 'Usuario Actualizado Satisfacotiamente!!!');
        }
        header("location: index.php?c=".Database::encryptor('encrypt', 'user')."user&a=".Database::encryptor('encrypt', 'index')."&m=".$msg.'&e='.$err);
    }

    public function login()
    {
        require_once 'view/message.php';
        require_once  'view/user/login.php';
        require_once 'view/footer.php';
    }

    public function validate($email, $password)
    {
        $msg = 'Datos De Ingreso Errados !!!';
        $err = 1;

        $row = $this->model->validate($email, $password);
        if ($row != false) {
            $this->model->lastAccess($row->id);
            $_SESSION['idUser'] = $row->id;
            $_SESSION['nameUser'] = $row->name;
            $msg = Database::encryptor('encrypt','Bienvenido al sistema!!!') ;
            $err = Database::encryptor('encrypt',0) ;
        }
        header('location: index.php?m='.$msg.'&e='.$err);
    }

    public function logout() {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header('Location: index.php');


    }

    public function  upload() {
        $id = Database::encryptor('decrypt', $_REQUEST['id']);
        require_once 'view/header.php';
        require_once 'view/message.php';
        require_once  'view/user/upload.php';
        require_once 'view/footer.php';

    }

    public function uploadFile()
    {
        $id = $_REQUEST['id'];

        $err = Database::encryptor('encrypt', 0);
        $msg = Database::encryptor('encrypt', 'Documento Subido Satisfactoriamente!!!');

        $target_dir = "documents/$id/";

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755);
        }
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name']);

        /*
        if ($_FILES["file"]["type"] == "application/pdf") {
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir."cedula.pdf");
        } else if ($_FILES["file"]["type"] == "image/jpeg") {
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir."cedula.jpg");
        } else if ($_FILES["file"]["type"] == "image/png") {
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir."cedula.png");
        } else {
            $err = Database::encryptor('encrypt', 1);
            $msg = Database::encryptor('encrypt', 'Documento Subido NO Valido!!!');
        }
        */

        header("location: index.php?c=".Database::encryptor('encrypt', 'user')."user&a=".Database::encryptor('encrypt', 'index')."&m=".$msg.'&e='.$err);
    }

    public function viewDoc() {
        $id = Database::encryptor('decrypt', $_REQUEST['id']);
        require_once 'view/header.php';
        require_once 'view/message.php';
        require_once  'view/user/viewDoc.php';
        require_once 'view/footer.php';
    }


}