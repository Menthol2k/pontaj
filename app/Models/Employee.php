<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'workbook' => 'boolean',
    ];

    public function workbook()
    {
        return $this->belongsTo(Workbook::class);
    }

    public function carteDeMunca()
    {
        return $this->workbook();
    }

}
