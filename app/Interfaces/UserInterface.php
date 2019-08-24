<?php

namespace Spafs\Interfaces;

interface UserInterface
{
    /**
     * Get all users info.
     *
     * @return void
     */
    public function getAllUsers();

    /**
     * Get a user info by userId
     *
     * @param integer $userId
     * @return void
     */
    public function getUser(int $userId);

    /**
     * Create a user.
     *
     * @param array $data
     * @return void
     */
    public function createUser(array $data);

    /**
     * Update a user info.
     *
     * @param array $data
     * @return void
     */
    public function updateUser(array $data);

    /**
     * Delete a user info by userId.
     *
     * @param integer $userId
     * @return void
     */
    public function deleteUser(int $userId);
}