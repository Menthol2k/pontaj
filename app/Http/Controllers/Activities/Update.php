<?php

namespace App\Http\Controllers\Activities;

use Carbon\Carbon;
use App\Models\Activity;
use App\Models\ActivityDay;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Update extends Controller
{
    public function __invoke(Activity $activity)
    {
        $prices = [
            'absent' => 0,
            'birou' => 300,
            'deplasare' => 350,
        ];

        $activity->type = request('type');
        $activity->price = $prices[request('type')];
        $activity->save();

        return Redirect::to("/activities/{$activity->activity_day_id}/show");
    }
}
