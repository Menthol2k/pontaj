<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = ['id'];

    public function activityDay()
    {
        return $this->belongsTo(ActivityDay::class, 'activity_day_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
