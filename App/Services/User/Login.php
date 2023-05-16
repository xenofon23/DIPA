<?php

namespace App\Services\User;

use App\Database\database;
use App\Helpers\AuthenticatedUser;
use Exception;
use MongoDB\BSON\UTCDateTime;

class Login
{
    use AuthenticatedUser;

    use database;

    private string $userName;
    private string $password;
    private string $token;

    private string $savedUserName;
    private string $savedPassword;
    private string $userId;

    /**
     * @param array $data
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->userName = $data['userName'];
        $this->password = hash('sha256', $data['password']);
        $this->setUp();
    }

    private function searchUserProfile()
    {
        $collection = $this->mongo('profiles');
        $projection = ['username' => 1, 'password' => 1, 'userId' => 1, '_id' => 0];
        $query = ['username' => $this->userName];
        $result = $collection->findOne($query, ['projection' => $projection]);
        return json_decode(json_encode($result, true), true);

    }

    /**
     * @throws Exception
     */
    private function setUp(): void
    {
        $userProfile = $this->searchUserProfile();
        if (is_null($userProfile)) {
            throw new Exception('user not found');
        }
        $this->setSavedUserName($userProfile['username']);
        $this->setSavedPassword($userProfile['password']);
        $this->setUserId($userProfile['userId']);
        $this->getUserDetailsInstance($this->userId);
    }


    /**
     * @throws Exception
     */
    public function loadService()
    {
        if ($this->matchUserCredentials()) {
            return $this->setAuthenticationCookie();
        }
        throw new Exception('fail password');

    }

    private function matchUserCredentials(): bool
    {
        if (hash_equals($this->password, $this->savedPassword)) {
            return true;
        }
        return false;
    }

    /**
     * @param String $savedUserName
     */
    private function setSavedUserName(string $savedUserName): void
    {
        $this->savedUserName = $savedUserName;
    }

    /**
     * @param string $userId
     */
    private function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @param String $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }


    /**
     * @param string $savedPassword
     */
    private function setSavedPassword(string $savedPassword): void
    {
        $this->savedPassword = $savedPassword;
    }

    /**
     * @throws Exception
     */
    //TODO REDIRECT
    public function setAuthenticationCookie(): string
    {

//        session_start();
//        $_SESSION["userId"] = $this->userId;

        $this->setToken(bin2hex(random_bytes(8)));
        $token = $this->token;
        $cookie_value = $this->userId . ':' . $token;
        $cookie_value = hash('sha256', $cookie_value);
        setcookie('auth', $cookie_value, time() + 600, '/');// expire after 10 minutes;
        $this->SetTokenInUserProfile();

//        header("Location: index.html");
        return json_encode(array(
            "success" => true,
            "message" => "login succesfully"
        ));
    }

    private function SetTokenInUserProfile()
    {
        $collection = $this->mongo('liveUsers');
        $hash = $this->userId . ':' . $this->token;
        $hash = hash('sha256', $hash);
        $documentFields = ['csrfToken' => $hash];

        $document = $collection->findOne(['userId' => $this->userId]);
        $expiryTime = (new UTCDateTime((time() + 600) * 1000));

        if ($document === null) {
            // insert new document
            $documentFields['userId'] = $this->userId;
            $documentFields['expiresAt'] = new UTCDateTime();

            $collection->insertOne($documentFields);
        } else {
            // update existing document
            $documentFields['expiresAt'] = new UTCDateTime();

            $collection->findOneAndUpdate(
                ['userId' => $this->userId],
                ['$set' => $documentFields]
            );
        }

    }

}