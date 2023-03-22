<?php
namespace App\Services;

use Exception;

class UserProfile
{
    use \App\Database\database;

    /**
     * @throws Exception
     */
    public function createUser(array $userDetails): false|string
    {
        $flag=$this->isRegisterUser($userDetails['userId']);
        if($flag) {
            try {
                $collection = $this->mongo('UserDetails');
                $collection->insertOne($userDetails);
                return 'profile has register';
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }else {
            header('Content-Type: application/json');
            return json_encode(array(
                "success" => false,
                "message" => "user has exist"
            ));
        }
    }

    public function isRegisterUser($userId):bool{
        $collection=$this->mongo('UserDetails');
        $query = ['userId' => $userId];
        $result = $collection->findOne($query);
        if(is_null($result)){
            return true;
        }
        return false;
    }
}