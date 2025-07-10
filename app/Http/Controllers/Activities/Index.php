<?php

namespace App\Http\Controllers\Activities;

use Inertia\Inertia;
use App\Models\ActivityDay;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class Index extends Controller
{
    public function __invoke()
    {
        request()->validate([
            'perPage' => [Rule::in([10, 15, 25])]
        ]);

        $perPage = request('perPage') ? request('perPage') : 15;
        $adays = ActivityDay::with('createdBy')->withCount('activities');

        return Inertia::render('Activities/Index', [
            'adays' => $adays->paginate($perPage)->withQueryString()
        ]);
    }
}
