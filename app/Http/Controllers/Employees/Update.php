<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\Redirect;

class Update extends Controller
{
    public function __invoke(Employee $employee)
    {
        request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'phone_number' => ['required'],
            'adresa' => ['required'],
            'position' => ['required'],
            'location' => ['required'],
            'hired_at' => ['required'],
            'left_at' => ['nullable'],
            'workbook' => ['required'],
            'status' => ['required'],
            'obs' => ['nullable'],
        ], [
            'required' => 'Campul este obligatoriu.',
        ]);

        $employee->update(request()->all());

        return Redirect::to('/employees');
    }
}
