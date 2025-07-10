<?php

namespace App\Http\Controllers\Activities;

use App\Exports\PontajExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class Export extends Controller
{
    public function __invoke($week, $year)
    {
        return Excel::download(new PontajExport($week, $year), 'pontaj.xlsx');
    }
}
