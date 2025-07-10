<?php

namespace App\Http\Controllers\Employees;

use Inertia\Inertia;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Employee;

class Index extends Controller
{
    public function __invoke()
    {
        request()->validate([
            'perPage' => [Rule::in([10, 15, 25])]
        ]);

        $perPage = request('perPage') ? request('perPage') : 15;

        $query = Employee::with('carteDeMunca')->orderBy('id', 'desc');

        return Inertia::render('Employees/Index', [
            'employee' => $query->paginate($perPage)->withQueryString(),
            'perPage' => (int) $perPage,
            'totalEmployees' => (int) Employee::count(),
        ]);
    }
}
