<?php

namespace App\Services\Contracts;

use App\Models\User;

interface AuthServiceContract
{
    public function create(array $data) : User;
}
