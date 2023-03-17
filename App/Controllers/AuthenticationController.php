<?php

namespace App\Controllers;

use App\Services\User\Login;
use App\Services\User\RegisterUser;
use App\Services\User\UserDetails;
use Exception;


class AuthenticationController
{
    private array $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @throws \Exception
     */
    public function enableLogin(): string
    {
        if (!isset($data['userName']) | !isset($data['password'])) {
            $login = new Login($this->data);
            return $login->loadService();
        }
        throw new Exception('den edoses username pass');
    }

    public function test(): string
    {$userDetails =UserDetails::getInstance();


        return $userDetails->getUserId();
    }

    /**
     * @throws \Exception
     */
    public function enableRegister(): string
    {
        if (!isset($data['userName']) | !isset($data['password'])) {
            $register=new RegisterUser($this->data);
            return $register->register();
        }
        throw new Exception('Den edoses stoixia isodou');

    }


}