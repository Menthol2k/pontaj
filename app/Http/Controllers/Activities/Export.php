<?php

namespace App\Http\Controllers\Activities;

use Carbon\Carbon;
use App\Models\Activity;
use Barryvdh\DomPDF\PDF;
use App\Exports\PontajExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class Export extends Controller
{
    public function __invoke($week, $year)
    {
        return Excel::download(new PontajExport($week, $year), 'pontaj.xlsx');
    }

    public function pdf($week, $year)
    {
        $activities = Activity::with('employee', 'activityDay')
            ->whereHas('activityDay', function ($q) use ($week, $year) {
                $q->where('week', $week)->whereYear('date', $year);
            })
            ->orderBy('date')
            ->get()
            ->map(function ($activity) {
                $date = Carbon::parse($activity->date);
                return [
                    'data' => $date->format('Y-m-d'),
                    'zi' => ucfirst($date->locale('ro')->isoFormat('dddd')),
                    'angajat' => $activity->employee->first_name . ' ' . $activity->employee->last_name,
                    'tip' => ucfirst($activity->type),
                    'suma' => $activity->price,
                    'saptamana' => $activity->activityDay->week ?? '',
                ];
            });

        $total = $activities->sum('suma');

        $pdf = app('dompdf.wrapper');

        $pdf->loadView('exports.pontaj-pdf', [
            'activities' => $activities,
            'total' => $total,
            'week' => $week,
            'year' => $year,
        ]);

        return $pdf->download("pontaj_sapt_{$week}_{$year}.pdf");
    }
}
