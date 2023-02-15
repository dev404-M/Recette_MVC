<?php

namespace Plat\Models;

/** Class User **/
class User
{
    private $id;
    private $code_client;
    private $password;
    private $permissions;

    public function getId() 
    {
        return $this->id;
    }

    public function getCodeClient()
    {
        return $this->code_client;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function gePermissions(){
        return $this->permissions;
    }


   public function setId($id)
    {
        $this->id = $id;
    }

    public function setCodeClient($code_client)
    {
        $this->code_client = $code_client;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function sePermissions($permissions){
        $this->permissions = $permissions;
    }

    
}