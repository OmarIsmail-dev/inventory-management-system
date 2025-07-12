<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class managers extends Model
{
    protected $fillable = ['user_id', 'name', 'department'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }

}
