<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text', 'employee_id'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
