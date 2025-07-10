<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityDay extends Model
{
    protected $guarded = ['id'];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
