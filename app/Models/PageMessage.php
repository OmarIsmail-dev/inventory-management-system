<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageMessage extends Model
{
    protected $fillable = ['title','AssignedTo', 'message', 'type', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
    
    public function receiver()
    {
        return $this->belongsTo(User::class, 'AssignedTo');
    }
}
