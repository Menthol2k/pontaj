<?php

namespace App\Http\Controllers\Activities;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Inertia\Inertia;

class Create extends Controller
{
    public function __invoke()
    {
        $employees = Employee::where('status', true)->get();

        return Inertia::render('Activities/Create', [
            'employees' => $employees
        ]);
    }
}
