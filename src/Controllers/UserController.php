<?php

namespace Plat\Controllers;

use Plat\Models\UserManager;
use Plat\Validator;

/** Class UserController **/
class UserController
{
    private $manager;
    private $validator;

    public function __construct()
    {
        $this->manager = new UserManager();
        $this->validator = new Validator();
    }

    public function index(){
        if (!isset($_SESSION['user']['id'])) {
           $this->showRegister();
           if ($_SESSION['user']['id'] == "0") {
            header("Location: /login");
        }
        }
        require VIEWS . 'Plat/index.php';
    }

    public function showLogin()
    {
        require VIEWS . 'Auth/login.php';
    }

    public function showRegister()
    {
        require VIEWS . 'Auth/register.php';
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login/');
    }

    public function register()
    {
        $this->validator->validate([
            "code_client" => ["required", "min:3", "alphaNum"],
            "password" => ["required", "min:6", "alphaNum", "confirm"],
            "passwordConfirm" => ["required", "min:6", "alphaNum"]
        ]);
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $res = $this->manager->find($_POST["code_client"]);
            $uuid = uniqid();
            if (empty($res)) {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $this->manager->store($uuid, $password);
              
                $_SESSION["user"] = [
                    "id" => $uuid,
                    "code_client" => $_POST["code_client"]
                ];
                header("Location: /");
            } else {
                $_SESSION["error"]['code_client'] = "Le code_client choisi est déjà utilisé !";
                header("Location: /register");
            }
        } else {
            header("Location: /register");
        }
    }

    public function login()
    {
        $this->validator->validate([
            "code_client" => ["required", "min:3", "max:9", "alphaNum"],
            "password" => ["required", "min:6", "alphaNum"]
        ]);

        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $res = $this->manager->find($_POST["code_client"]);
            var_dump($res);
           if ($res && password_verify($_POST['password'], $res->getPassword())) {
                $_SESSION["user"] = [
                    "id" => $res->getId(),
                    "code_client" => $res->getCodeClient()
                ];
                header("Location: /");
             } else {
                $_SESSION["error"]['message'] = "Une erreur sur les identifiants";
                header("Location: /login");
            }
        } else {
            header("Location: /login");
        }
    }
}