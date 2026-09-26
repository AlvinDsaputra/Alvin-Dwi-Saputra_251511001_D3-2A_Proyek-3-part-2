<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Collection;

class ActivityService
{
    public function getAllActivities(): Collection
    {
        return Activity::latest()->get();
    }

    public function createActivity(array $data): Activity
    {
        return Activity::create($data);
    }

    public function updateActivity(Activity $activity, array $data): bool
    {
        return $activity->update($data);
    }

    public function deleteActivity(Activity $activity): bool
    {
        return $activity->delete();
    }
}