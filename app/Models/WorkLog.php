<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkLog extends Model
{
    protected $fillable = ['worker_id', 'status'];

    public function worker() {
        return $this->belongsTo(Worker::class);
    }


    

}
