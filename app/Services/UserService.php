<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Fetch the latest agent from the user table.
     *
     * @return \App\Models\User|null
     */
    public function agent()
    {
        // Fetch all users who are agents
        return User::where('is_agent', 1)->first();
    }
}
