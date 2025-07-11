<?php

namespace App\Http\Controllers\Activities;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Employee;
use Inertia\Inertia;

class Show extends Controller
{
    public function __invoke(Activity $activity)
    {
        $activity = Activity::with('activityDay', 'employee', 'createdBy')->where('activity_day_id', $activity->id)->get();

        return Inertia::render('Activities/Show', [
            'activities' => $activity
        ]);
    }
}
