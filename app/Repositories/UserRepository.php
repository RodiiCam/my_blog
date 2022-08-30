<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * User
     * 
     * @var User
     */
    protected $user;

    /**
     * Create UserRepository instance
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user by id
     *
     * @return User
     */
    public function getUserById($id)
    {
        return $this->user->where('id', $id)->first();
    }
}