<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Inertia\Inertia;

class Edit extends Controller
{
    public function __invoke(Employee $employee)
    {
        return Inertia::render('Employees/Edit', [
            'employee' => $employee
        ]);
    }
}
