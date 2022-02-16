<?php

namespace App\Services;

use App\Services\Contracts\TrackingServiceContract;
use App\Repositories\Contracts\TrackingRepositoryContract;
use App\Models\Tracking;
use Illuminate\Database\Eloquent\Collection;

class TrackingService implements TrackingServiceContract
{
    public function __construct(protected TrackingRepositoryContract $trackingRepository)
    {
    }

    public function create(array $data) : Tracking
    {
        return $this->trackingRepository->create($data);
    }

    public function getAll(int $userId) : Collection
    {
        return $this->trackingRepository->getAll($userId);
    }

    public function get(int $id, int $userId) : Tracking
    {
        return $this->trackingRepository->get($id, $userId);
    }

    public function update(int $id, array $data) : Tracking
    {
        return $this->trackingRepository->update($id, $data);
    }

    public function delete(int $id, int $userId) : bool
    {
        return $this->trackingRepository->delete($id, $userId);
    }
}
