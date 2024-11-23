<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterEvent extends Model
{
    protected $table = 'register_event';

    protected $fillable = ['code', 'event_id', 'user_id', 'status', 'virtual_account'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
