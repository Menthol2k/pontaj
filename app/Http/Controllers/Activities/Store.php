<?php

namespace App\Http\Controllers\Activities;

use Carbon\Carbon;
use App\Models\Activity;
use App\Models\ActivityDay;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Store extends Controller
{
    public function __invoke()
    {
        $prices = [
            'absent' => 0,
            'birou' => 300,
            'deplasare' => 350,
        ];

        $pontaje = request()->all();
        $grandTotal = 0;

        foreach ($pontaje as $pontaj) {
            $type = strtolower($pontaj['type']);
            $grandTotal += $prices[$type] ?? 0;
        }

        $aday = ActivityDay::create([
            'date' => $pontaje[0]['date'],
            'week' => Carbon::parse($pontaje[0]['date'])->isoWeek(),
            'grand_total' => $grandTotal,
            'created_by' => Auth::id(),
        ]);

        foreach ($pontaje as $pontaj) {
            $type = strtolower($pontaj['type']);
            $price = $prices[$type] ?? 0;

            Activity::create([
                'employee_id' => $pontaj['employee_id'],
                'type' => $pontaj['type'],
                'week' => Carbon::parse($pontaj['date'])->isoWeek(),
                'date' => $pontaj['date'],
                'activity_day_id' => $aday->id,
                'price' => $price,
                'created_by' => Auth::id()
            ]);
        }

        return Redirect::to('/activities');
    }
}
