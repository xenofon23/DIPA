<?php

namespace App\Controllers;



use App\Services\User\UserDetails;
use App\Services\UserProfile;
use Exception;

class UserDetailsController
{

    private array $data;
    private string $userId;

    private UserProfile $userProfile;
    /**
     * @param array $data
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->userProfile=new UserProfile();
        $userDetails = UserDetails::getInstance();
        $this->userId=$userDetails->getUserId();
    }

    /**
     * @throws Exception
     */
    public function createProfile(){
        //TODO VALIDATION
        $this->data['userId']= $this->userId;
        return $this->userProfile->createUser($this->data);
    }

}