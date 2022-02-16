<?php

namespace App\Repositories;

use App\Repositories\Contracts\AuthRepositoryContract;
use App\Models\User;

class AuthRepository implements AuthRepositoryContract
{
    public function __construct(protected User $model)
    {
    }

    public function create(array $data) : User
    {
        $data['password'] = bcrypt($data['password']);
        
        return $this->model->create($data);
    }
}
