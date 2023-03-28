<?php
namespace App\Services;
use MongoDB;
use Exception;
use InvalidArgumentException;

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
                header('Content-Type: application/json');
                return json_encode(array(
                    "success" => true,
                    "message" => "profile add"
                ));
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

    /**
     * @throws Exception
     */
    public function updateUserProfile(array $userDetails)
    {
        // TODO Validate input

        try {
            $collection = $this->mongo('UserDetails');
            $filter = ['userId' => $userDetails['userId']];
            $update = ['$set' => $userDetails];
            $collection->updateOne($filter, $update);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return json_encode(array(
            "success" => true,
            "message" => "profile update"
        ));

    }
}