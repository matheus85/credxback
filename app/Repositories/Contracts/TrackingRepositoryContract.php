<?php

namespace App\Repositories\Contracts;

use App\Models\Tracking;
use Illuminate\Database\Eloquent\Collection;

interface TrackingRepositoryContract
{
    public function create(array $data) : Tracking;
    public function getAll(int $userId) : Collection;
    public function get(int $id, int $userId) : Tracking;
    public function update(int $id, array $data) : Tracking;
    public function delete(int $id, int $userId) : bool;
}
