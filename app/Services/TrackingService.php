<?php

namespace App\Services;

use App\Services\Contracts\TrackingServiceContract;
use App\Repositories\Contracts\TrackingRepositoryContract;
use App\Models\Tracking;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

class TrackingService implements TrackingServiceContract
{
    public function __construct(protected TrackingRepositoryContract $trackingRepository)
    {
    }

    public function create(array $data, User $user) : Tracking
    {
        $data['user_id'] = $user->id;

        $tracking = $this->trackingRepository->create($data);

        if (!empty($tracking)) {
            $user->createTrackingNotification();
        }

        return $tracking;
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
