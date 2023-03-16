<?php

namespace App\Helpers;

use App\Database\database;
use Exception;

trait AuthenticatedUser
{
    use database;
    /**
     * @throws Exception
     */
    public function isAuthUser($cookie){
        if(!isset($cookie)){
            throw new Exception('epp ti pas na kanis');
        }
        $explodes=explode(':',$cookie);

        $collection=$this->mongo('liveUsers');
        $document=$collection->findOne(['csrfToken' =>$cookie]);
        if(is_null($document)) {
            throw new Exception('epp ti pas na kanis');
        }
        $savedHash=$document['csrfToken'];
        $savedCookie = hash('sha256',$savedHash);
        if ($savedHash!=$cookie){
            throw new Exception('epp ti pas na kanis');
        }

    }


}