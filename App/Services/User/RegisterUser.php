<?php

namespace App\Services\User;

use App\Database\database;
use Exception;

class RegisterUser
{
    use database;
    private string $userName;
    private string $password;
    private String $userId;

    /**
     * @throws \Exception
     */
    public function __construct(array $data)
    {
        $this->userName=$data['userName'];
        $this->password= hash('sha256',$data['password']);
        $this->userId=bin2hex(random_bytes(16));
    }

    /**
     * @throws Exception
     */
    private function isRegisterUser(): bool
    {
        $collection=$this->mongo('profiles');
        $projection = ['username' => 1, 'password' => 0,'userId'=>0, '_id' => 0];
        $query = ['username' => $this->userName];
        $result = $collection->findOne($query);
        if(is_null($result)){
            return true;
        }
        return false;

    }
//TODO REDIRECT

    /**
     * @throws Exception
     */
    public function register(): string
    {if($this->isRegisterUser()){
        $collection=$this->mongo('profiles');
        $document=[
            'username'=>$this->userName,
            'userId'=>$this->userId,
            'password'=>$this->password
            ];
        $result = $collection->insertOne($document);
        // header("Location: index.html");
        return json_encode(array(
            "success" => true,
            "message" => "Register successfully!"
        ));
    }else{
        header('Content-Type: application/json');
        return json_encode(array(
            "success" => false,
            "message" => "user has exist"
        ));
    }
    }



}