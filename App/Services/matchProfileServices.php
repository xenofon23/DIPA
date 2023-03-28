<?php

namespace App\Services;
use App\Database\database;
use Exception;

class matchProfileServices
{
    private  array|null $user;

    use database;


    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUser();
        echo '';
    }

    /**
     */
    public function setUser(): void
    {
//        $userDetails = UserDetails::getInstance();
//        $userId=$userDetails->getUserId();
        $userId='b8fd04112ae91cb4bb59750a6b5af6f2';
        $collection=$this->mongo('UserDetails');
        $this->user=json_decode(json_encode($collection->findOne(["userId"=>$userId]),1),1);

    }

    private function calculateScore($profile)
    {
        $score = 0;
        $result = [];

        // Basic location matching
        if ($profile->basic->location !== $this->user['basic']['location']) {
            return 0; // set the score to 0 and add the profile ID to the result array
        }


        $userBudget = (int)$this->user['basic']['budget']; // cast the user's budget to an integer
        $profileBudget = (int)$profile->basic->budget; // cast the profile's budget to an integer
        $diff = abs($userBudget - $profileBudget);
        if ($diff <= 50) {
            $score +=50 - $diff;
        }else{
            return 0;
        }

        $diff = abs($this->user['second']['age'] - $profile->second->age);
        if ($diff <= 10) {
            $score += 10 - $diff;
        }
        if ($this->user['second']['pet'] === $profile->second->pet) {
            $score += 10;
        }
        if ($this->user['second']['gender'] === $profile->second->gender) {
            $score += 10;
        }
        if ($this->user['second']['smoke'] === $profile->second->smoke) {
            $score += 10;
        }
        if ($this->user['second']['housework']['clean'] !== $profile->second->housework->clean) {
            $score += 10;
        }
        return $score; // return the result array

    }

    public function findBestMatch() {
        $max_score = 0;
        $best_match = null;
        $score=[];
        $collection=$this->mongo('UserDetails');
        $profiles = $collection->find();
        foreach ($profiles as $profile) {
            if($this->user['userId']!==$profile->userId) {
                $score[$profile->userId] = $this->calculateScore($profile);
            }
        }
        $maxValue = max($score);
        if(is_array($maxValue) ){
            if($maxValue[0]===0){
                return json_encode(array(
                    "success" => false,
                    "message" => "you don't match any profile"
                ));
            }
        }
        $maxUsersId = array_keys($score, $maxValue);
        $data=$this->getmatchedProfiles( $maxUsersId);
        return json_encode(array(
            "success" => false,
            "message" => $data
        ));
    }
    public function getmatchedProfiles($maxUsesrId){
        $data=[];
        $collection=$this->mongo('UserDetails');
        foreach ($maxUsesrId as $id) {
            $filter = ['userId' => "$id"];
            $profiles = $collection->find($filter);
            $data[] = iterator_to_array($profiles);
        }

        return $data;
    }
}
