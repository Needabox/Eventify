<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'name',
        'description',
        'capacity_type',
        'capacity_max',
        'start_date',
        'end_date',
        'status',
        'user_id',
        'event_type',
        'location',
        'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registerEvents()
    {
        return $this->hasMany(RegisterEvent::class, 'event_id');
    }
}
