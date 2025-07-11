<?php

namespace App\Http\Controllers\Activities;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Employee;
use Inertia\Inertia;

class Edit extends Controller
{
    public function __invoke(Activity $activity)
    {
        $activity->load('employee');

        return Inertia::render('Activities/Edit', [
            'activity' => $activity
        ]);
    }
}
