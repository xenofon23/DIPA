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
     * @param UserProfile $userProfile
     * @param array $data
     * @throws Exception
     */
    public function __construct(UserProfile $userProfile,array  $data)
    {
        $this->data = $data;
        $this->userProfile=$userProfile;
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

    /**
     * @throws Exception
     */
    public function updateProfile(){
        $this->data['userId']= $this->userId;
        return $this->userProfile->updateUserProfile($this->data);
    }

}