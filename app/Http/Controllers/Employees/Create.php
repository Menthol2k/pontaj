<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class Create extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Employees/Create');
    }
}
