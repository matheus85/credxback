<?php

namespace App\Services;

use App\Services\Contracts\AuthServiceContract;
use App\Repositories\Contracts\AuthRepositoryContract;
use App\Models\User;

class AuthService implements AuthServiceContract
{
    public function __construct(protected AuthRepositoryContract $authRepository)
    {
    }

    public function create(array $data) : User
    {
        return $this->authRepository->create($data);
    }
}
