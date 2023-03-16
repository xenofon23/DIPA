<?php

namespace App\Controllers;

use App\Services\Login;
use PHPMailer\PHPMailer\Exception;
use function PHPUnit\Framework\isEmpty;

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
        if (!isset($data['userName']) && !isset($data['password'])) {
            $login = new Login($this->data);
            return $login->loadService();
        }
        throw new \Exception('den edoses username pass');
    }

    public function test(): string
    {
        return 'perasa';
    }



}