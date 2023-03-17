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
        $this->isRegisterUser();
        $this->userId=bin2hex(random_bytes(16));
    }

    /**
     * @throws Exception
     */
    private function isRegisterUser(): void
    {
        $collection=$this->mongo('profiles');
        $projection = ['username' => 1, 'password' => 0,'userId'=>0, '_id' => 0];
        $query = ['username' => $this->userName];
        $result = $collection->findOne($query);
        if(!is_null($result)){
            trigger_error('user exist');
        }

    }
//TODO REDIRECT
    public function register(): string
    {
        $collection=$this->mongo('profiles');
        $document=[
            'username'=>$this->userName,
            'userId'=>$this->userId,
            'password'=>$this->password
            ];
        $result = $collection->insertOne($document);
        // header("Location: index.html");
        return 'Register successfully!';
    }


}