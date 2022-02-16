<?php

namespace App\Services\Contracts;

use App\Models\Tracking;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

interface TrackingServiceContract
{
    public function create(array $data, User $user) : Tracking;
    public function getAll(int $userId) : Collection;
    public function get(int $id, int $userId) : Tracking;
    public function update(int $id, array $data) : Tracking;
    public function delete(int $id, int $userId) : bool;
}
