<?php

namespace Plat\Models;

use Plat\Models\User;

/** Class UserManager **/
class UserManager
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getBdd()
    {
        return $this->bdd;
    }

    public function find($code_client)
    {
        $stmt = $this->bdd->prepare("SELECT * FROM users WHERE code_client = ?");
        $stmt->execute(array(
            $code_client
        ));
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "Plat\Models\User");

        return $stmt->fetch();
    }

    public function all()
    {
        $stmt = $this->bdd->query('SELECT * FROM users');

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Plat\Models\User");
    }

    public function store($uuid, $password)
    {
        $stmt = $this->bdd->prepare("INSERT INTO users (id, code_client, password, permissions) VALUES (:id, :code_client, :password, :permissions)");
        $stmt->execute(array(
            "id" => $uuid, 
            "code_client" => htmlentities($_POST["code_client"]),   
            "password" => htmlentities($password),    
            'permissions' => 0,
        ));
    }
}