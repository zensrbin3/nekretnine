<?php

namespace App\Repositories;

use App\RepositoryInterface;
use App\Models\User;

class UserRepository implements RepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
