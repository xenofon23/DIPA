<?php
namespace App\Services;
use App\Helpers\AuthenticatedUser;
use App\Services\User\UserDetails;
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
        $flag=$this->isRegisterUser();
        if($flag===true) {
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

    /**
     * @throws Exception
     */
    public function isRegisterUser():bool| string{
        $userDetails = UserDetails::getInstance();
        $userId=$userDetails->getUserId();
        $collection=$this->mongo('UserDetails');
        $query = ['userId' => $userId];
        $result = $collection->findOne($query);
        if(is_null($result)){
            return true;
        }
        return json_encode(iterator_to_array($result));
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
    public function ShowUsersProfiles(){
        $collection = $this->mongo('UserDetails');
        $results = $collection->find();
       return json_encode(iterator_to_array($results));
    }
}