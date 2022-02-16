<?php

namespace App\Repositories;

use App\Repositories\Contracts\TrackingRepositoryContract;
use App\Models\Tracking;
use Illuminate\Database\Eloquent\Collection;

class TrackingRepository implements TrackingRepositoryContract
{
    public function __construct(protected Tracking $model)
    {
    }

    public function create(array $data) : Tracking
    {
        return $this->model->create($data);
    }

    public function getAll(int $userId) : Collection
    {
        return $this->model->where('user_id', $userId)->get();
    }

    public function get(int $id, int $userId) : Tracking
    {
        return $this->model->where([
            ['id', $id],
            ['user_id', $userId],
        ])->first();
    }

    public function update(int $id, array $data) : Tracking
    {
        $tracking = $this->model->where([
            ['id', $id],
            ['user_id', $data['user_id']]
        ])->first();

        $tracking->fill($data)->save();

        return $tracking;
    }

    public function delete(int $id, int $userId) : bool
    {
        return $this->model->where([
            ['id', $id],
            ['user_id', $userId]
        ])->delete();
    }
}
