<?php

namespace App\Services\User;

use Exception;

class UserDetails
{
    private static $instance;
    private string $userId;

    /**
     * @param string $userId
     */
    private function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string|null $userId
     * @return UserDetails
     * @throws Exception
     */
    public static function getInstance(string $userId = null): UserDetails
    {
        if (!isset(self::$instance)) {
            if ($userId === null) {
                throw new Exception('UserID cannot be null');
            }
            self::$instance = new UserDetails($userId);
        }
        return self::$instance;
    }
}