<?php

namespace App\Helpers;

use App\Database\database;
use App\Services\User\UserDetails;
use Exception;

trait AuthenticatedUser
{
    use database;
    /**
     * @throws Exception
     */
    public function isAuthUser($cookie): void
    {
        if(!isset($cookie)){
            throw new Exception('epp ti pas na kanis');
        }
        $document= $this->getCredentials($cookie);
        $this->tokenVerify($document,$cookie);
        $this->getUserDetailsInstance($document['userId']);

    }

    /**
     * @throws Exception
     */
    public function getUserDetailsInstance(string $userId):void
    {
         UserDetails::getInstance($userId);
    }
    public function enableSession($document): void
    {
        session_start();
        $_SESSION["userId"]=$document['userId'];

    }

    /**
     * @throws Exception
     */
    private function getCredentials($cookie): object|array
    {
        $collection=$this->mongo('liveUsers');
        $document=$collection->findOne(['csrfToken' =>$cookie]);
        if(is_null($document)) {
            throw new Exception('epp ti pas na kanis');
        }
        return $document;
    }

    /**
     * @throws Exception
     */
    private function tokenVerify($document, $cookie): void
    {
        $savedHash=$document['csrfToken'];
        if ($savedHash!=$cookie){
            throw new Exception('epp ti pas na kanis');
        }


    }


}