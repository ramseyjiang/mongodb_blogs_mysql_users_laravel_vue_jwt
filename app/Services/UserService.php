<?php

namespace Spafs\Services;

use Spafs\Interfaces\UserInterface;
use Spafs\Models\User;

class UserService implements UserInterface
{
    /**
     * Create a user.
     *
     * @param array $data
     * @return void
     */
    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    /**
     * Get all users info.
     *
     * @return void
     */
    public function getAllUsers()
    {

    }

    /**
     * @inheritdoc
     */
    public function getUser(int $userId)
    {

    }

    /**
     * Update a user info.
     *
     * @param array $data
     * @return void
     */
    public function updateUser(array $data)
    {

    }

    /**
     * Delete a user info by userId.
     *
     * @param integer $userId
     * @return void
     */
    public function deleteUser(int $userId)
    {

    }
}