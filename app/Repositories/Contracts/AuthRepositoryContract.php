<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface AuthRepositoryContract
{
    public function create(array $data) : User;
}
